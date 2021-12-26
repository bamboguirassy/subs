<?php

namespace App\Http\Controllers;

use App\Custom\Event;
use App\Custom\Helper;
use App\Custom\PaymentManager;
use App\Mail\ContactParticipants;
use App\Models\Facture;
use App\Models\ProfilConcerne;
use App\Models\Programme;
use App\Models\Souscription;
use App\Models\SouscriptionTemp;
use App\Models\SubSouscriptionTemp;
use App\Models\User;
use App\Notifications\NotifyNewSouscription;
use App\Notifications\SendSms;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SouscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valider les champs obligatoires propres à programme
        $request->validate([
            'programme_id' => 'required|exists:programmes,id',
        ]);
        // démarrer la transaction
        DB::beginTransaction();
        try {
            $programme = Programme::find($request->get('programme_id'));
            if (!$programme->is_formation_modulaire) {
                // vérifier si user n'a pas déja souscrit
                if ($programme->current_user_souscription) {
                    notify()->warning("Vous avez déja souscrit à ce programme !");
                    return redirect()->route('programme.show', compact('programme'));
                }
                // vérifier si le nombre de souscription est atteint
                if ($programme->nombreParticipants > 0) {
                    if ($programme->nombreParticipants == count($programme->souscriptions)) {
                        $errorMsg = "Il n'y a plus de place disponible, merci de contacter le responsable du programme...";
                        notify()->error($errorMsg);
                        return back()->withErrors($errorMsg);
                    }
                }
            }
            // verifier si l'utilisateur est connecté
            if (Auth::check()) {
                // si user connecté, associer le programme à l'utilisateur connecté
                $userId = Auth::id();
            } else {
                $user = Helper::createUserFromRequest();
                if ($user == null) {
                    return back()->withInput();
                }
                $userId = $user->id;
            }
            if ($programme->is_programme) {
                $request->validate([
                    'profil_concerne_id' => 'required|exists:profil_concernes,id',
                ]);
            }
            if ($request->exists('profil_concerne_id')) {
                // recuperer le profil selectionné
                $profilConcerne = ProfilConcerne::find($request->get('profil_concerne_id'));
                // recuperer le profil concerne et verifier si le paiement est gratuit
                if ($profilConcerne->montant == 0) {
                    // souscribe directly
                    $souscription = new Souscription($request->all());
                    $souscription->user_id = $userId;
                    $souscription->montant = 0;
                    $souscription->uid = uniqid();
                    $souscription->save();
                    $souscription->user->notify(new NotifyNewSouscription($souscription));
                    Event::dispatchUserEvent(Event::Message("Nouvelle souscription", "{$souscription->user->name} a souscrit au programme {$programme->nom}."), $programme->user);
                    notify()->success("Vous avez souscrit avec succès au programme !!!");
                } else {
                    // instancier la souscription temp avec le contenu du request
                    $souscriptionTemp = new SouscriptionTemp($request->all());
                    $souscriptionTemp->uid = uniqid();
                    $souscriptionTemp->user_id = $userId;
                    $souscriptionTemp->montant = $profilConcerne->montant;
                    $souscriptionTemp->save();
                    // terminer la transaction
                    $redirectUrl = PaymentManager::initPayment($souscriptionTemp);
                }
            } else if ($programme->is_session_formation) {
                // s'il s'agit de session, verifier qu'il y'a des modules auxquels on souscrit
                if (!$request->exists('moduleIds')) {
                    notify()->error("Aucun module selectionné pour la souscription...");
                    return back();
                }
                $modules = Programme::whereIn('id', $request->moduleIds)->get();
                $montant = $modules->reduce(function ($total, $module) {
                    return $total + $module->montant;
                }, 0);
                if ($montant == 0) {
                    // créer directement la souscription pour chaque module car gratuit
                    foreach ($modules as $module) {
                        $souscription = new Souscription();
                        $souscription->user_id = $userId;
                        $souscription->montant = 0;
                        $souscription->uid = uniqid();
                        $souscription->programme_id = $module->id;
                        $souscription->session_id = $programme->id;
                        $souscription->save();
                        $souscription->user->notify(new NotifyNewSouscription($souscription));
                        Event::dispatchUserEvent(Event::Message("Nouvelle souscription", "{$souscription->user->name} a souscrit au programme {$programme->nom}."), $programme->user);
                    }
                    // retourner sur le show du module avec confirmation de message
                    notify("Vous avez souscrit aux modules selectionnés...");
                    return redirect()->route('programme.show', ['programme' => $programme->parent]);
                }
                // instancier la souscription temp avec le contenu du request
                $souscriptionTemp = new SouscriptionTemp($request->all());
                $souscriptionTemp->uid = uniqid();
                $souscriptionTemp->user_id = $userId;
                $souscriptionTemp->montant = $montant;
                $souscriptionTemp->save();
                // associer les modules temps à la souscription
                foreach ($modules as $module) {
                    // créer les souscriptions temps de modules et les associer à la souscriptiontemp
                    // si module gratuit, créer souscription
                    if ($module->montant == 0) {
                        $souscription = new Souscription();
                        $souscription->user_id = $userId;
                        $souscription->montant = 0;
                        $souscription->uid = uniqid();
                        $souscription->programme_id = $module->id;
                        $souscription->session_id = $programme->id;
                        $souscription->save();
                        $souscription->user->notify(new NotifyNewSouscription($souscription));
                        Event::dispatchUserEvent(Event::Message("Nouvelle souscription", "{$souscription->user->name} a souscrit au programme {$programme->nom}."), $programme->user);
                    }
                    // si module payant, créer sub souscription temp
                    if ($module->montant > 0) {
                        $subSouscriptionTemp = new SubSouscriptionTemp();
                        $subSouscriptionTemp->montant = $module->montant;
                        $subSouscriptionTemp->programme_id = $module->id;
                        // rattacher à souscription temp
                        $subSouscriptionTemp->souscription_temp_id = $souscriptionTemp->id;
                        $subSouscriptionTemp->save();
                    }
                }
                // terminer la transaction
                $redirectUrl = PaymentManager::initPayment($souscriptionTemp);
            } else if ($programme->is_tontine || $programme->is_cotisation_recurrente) {
                // si child programme, s'assurer que le participant a souscrit à la tontine
                if ($programme->programme_id != null && !$programme->parent->current_user_souscription) {
                    $errorMsg = "Vous n'êtes pas autorisé à participer à ce programme car vous ne vous étiez pas inscrit, merci de contacter le responsable...";
                    notify()->error($errorMsg);
                    return back()->withInput()->withErrors($errorMsg);
                }
                // verifier si programme parent -- que le nombre de place restant n'est pas épuisé
                if ($programme->is_tontine) {
                    if ($programme->is_parent && $programme->nombreParticipants != 0) {
                        if (($programme->nombre_main_souscrite + $request->get('nombreMain')) > $programme->nombreParticipants) {
                            if ($programme->nombreParticipants == $programme->nombre_main_souscrite) {
                                $errorMsg = "Ce programme a atteint le seuil de souscription. Rendez-vous pour d'autres tontines...,Merci.";
                            } else {
                                $errorMsg = "Le nombre de main proposé n'est pas disponible..., il reste actuellement " . ($programme->nombreParticipants - $programme->nombre_main_souscrite);
                            }
                            notify()->error($errorMsg);
                            return back()->withInput()->withErrors($errorMsg);
                        }
                    }
                }
                if ($programme->is_parent) {
                    $souscription = new Souscription($request->all());
                    $souscription->user_id = $userId;
                    $souscription->montant = 0;
                    $souscription->uid = uniqid();
                    $souscription->save();
                    $souscription->user->notify(new NotifyNewSouscription($souscription));
                    Event::dispatchUserEvent(Event::Message("Nouvelle souscription", "{$souscription->user->name} a souscrit au programme {$programme->nom}."), $programme->user);
                    notify()->success("Vous avez souscrit avec succès à la tontine !!!");
                } else {
                    if ($programme->is_tontine) {
                        // tontine enfant
                        $montant = $programme->parent->current_user_souscription->nombreMain * $programme->montant;
                    } else {
                        $montant = $programme->montant;
                    }
                    // instancier la souscription temp avec le contenu du request
                    $souscriptionTemp = new SouscriptionTemp($request->all());
                    $souscriptionTemp->uid = uniqid();
                    $souscriptionTemp->user_id = $userId;
                    $souscriptionTemp->montant = $montant;
                    $souscriptionTemp->save();
                    // terminer la transaction
                    $redirectUrl = PaymentManager::initPayment($souscriptionTemp);
                }
            } else if ($programme->is_collecte_fond) {
                $request->validate([
                    'montant' => 'required'
                ]);
                // instancier la souscription temp avec le contenu du request
                $souscriptionTemp = new SouscriptionTemp($request->all());
                $souscriptionTemp->uid = uniqid();
                $souscriptionTemp->user_id = $userId;
                $souscriptionTemp->montant = $request->montant;
                $souscriptionTemp->save();
                // terminer la transaction
                $redirectUrl = PaymentManager::initPayment($souscriptionTemp);
            } else if ($programme->typeProgramme->code == "COTI") {
                // instancier la souscription temp avec le contenu du request
                $souscriptionTemp = new SouscriptionTemp($request->all());
                $souscriptionTemp->uid = uniqid();
                $souscriptionTemp->user_id = $userId;
                $souscriptionTemp->montant = $programme->montant;
                $souscriptionTemp->save();
                // terminer la transaction
                $redirectUrl = PaymentManager::initPayment($souscriptionTemp);
            }
            DB::commit();
            if (!Auth::check()) {
                if (Auth::attempt($request->only('email', 'password'))) {
                    notify()->success("Vous êtes connecté à  votre compte !");
                }
            }
            // gérer le paiement par paytech
            return isset($redirectUrl) ? redirect()->to($redirectUrl) : redirect()->route('programme.show', compact('programme'));
        } catch (Exception $e) {
            notify()->error("Une erreur s'est produite pendant la souscription, merci de réssayer !");
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Souscription  $souscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Souscription $souscription)
    {
        if ($request->has('montant')) {
            $request->validate([
                'montant' => 'required|numeric|min:0'
            ]);
            $souscription->montant = $request->montant;
        }
        $souscription->update();
        notify("La souscription est mise à jour avec succès !");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Souscription $souscription)
    {
        if ($souscription->delete()) {
            notify("Suppression reussie !");
        } else {
            notify()->error("Une erreur est survenue lors de la suppression de la souscription.");
        }
        return back();
    }

    public function instantPaymentNotificate(Request $request)
    {
        $type_event = $request->input('type_event');
        $payment_method = $request->input('payment_method');
        $client_phone = $request->input('client_phone');
        $uid = $request->input('ref_command');
        $item_name = $request->input('item_name');
        $item_price = $request->input('item_price');
        $currency = $request->input('devise');

        //from PayTech
        if ($type_event == 'sale_complete') {
            DB::beginTransaction();
            try {
                // recuperer la souscription temp
                $souscriptionTemp = SouscriptionTemp::where('uid', $uid)->first();
                if (!$souscriptionTemp) {
                    throw new Error("Aucune souscription pour le uid {$uid} n'est trouvée !");
                }
                if ($souscriptionTemp->programme->is_session_formation) {
                    // recuperer les modules sous souscrits pour les transformer en souscription
                    $subSouscriptionTemps = SubSouscriptionTemp::where('souscription_temp_id', $souscriptionTemp->id)->get();
                    foreach ($subSouscriptionTemps as $subSouscriptionTemp) {
                        $souscription = new Souscription();
                        // definir le module souscrit
                        $souscription->programme_id = $subSouscriptionTemp->programme_id;
                        $souscription->session_id = $souscriptionTemp->programme_id;
                        $souscription->montant = $subSouscriptionTemp->montant;
                        $souscription->uid = uniqid();
                        $souscription->user_id = $souscriptionTemp->user_id;
                        $souscription->save();
                        $facture = new Facture();
                        $facture->methodePaiement = $payment_method;
                        $facture->clientPhone = $client_phone;
                        $facture->libelle = $item_name;
                        $facture->montant = $subSouscriptionTemp->montant;
                        $facture->currency = $currency ?? 'xof';
                        $facture->uid = $souscription->uid;
                        $facture->souscription_id = $souscription->id;
                        $facture->save();
                        $souscription->user->notify(new NotifyNewSouscription($souscription));
                    }
                    SubSouscriptionTemp::destroy($subSouscriptionTemps);
                    Event::dispatchUserEvent(Event::Message("Nouvelle souscription", "{$souscription->user->name} a souscrit au module {$souscription->programme->nom}."), $souscription->programme->user);
                } else {
                    $souscription = Helper::convertTempSouscription($souscriptionTemp);
                    $souscription->save();
                    $facture = new Facture();
                    $facture->methodePaiement = $payment_method;
                    $facture->clientPhone = $client_phone;
                    $facture->libelle = $item_name;
                    $facture->montant = $item_price;
                    $facture->currency = $currency ?? 'xof';
                    $facture->uid = $uid;
                    $facture->souscription_id = $souscription->id;
                    $facture->save();
                    $souscription->user->notify(new NotifyNewSouscription($souscription));
                    Event::dispatchUserEvent(Event::Message("Nouvelle souscription", "{$souscription->user->name} a souscrit au programme {$souscription->programme->nom}."), $souscription->programme->user);
                }
                // recuperer toutes les autres souscriptions temp à ce program pour le meme user et supprimer
                $souscriptionTemps = SouscriptionTemp::where('programme_id', $souscriptionTemp->programme_id)
                    ->where('user_id', $souscriptionTemp->user_id)
                    ->get();
                SouscriptionTemp::destroy($souscriptionTemps);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
        } else {
            // notifier de paiement sale_canceled
        }
    }

    public function sendMail(Request $request, Programme $programme)
    {
        $request->validate([
            'objet' => 'required',
            'message' => 'required'
        ]);
        // find participants
        $souscriptions = Souscription::where('programme_id', $programme->id)->get();
        // recuperer les mails
        $mails = [];
        foreach ($souscriptions as $souscription) {
            $mails[] = $souscription->user->email;
        }
        Mail::to(config('mail.cc'))->bcc($mails)->send(new ContactParticipants($programme, $request->only('message', 'objet')));
        notify()->success("Le mail est envoyé à tous les participants...");
        return back();
    }

    public function sendSMS(Request $request, Programme $programme)
    {
        $request->validate([
            'message' => 'required'
        ]);
        // find participants
        $souscriptions = Souscription::where('programme_id', $programme->id)->get();
        // recuperer les mails
        $phones = [];
        foreach ($souscriptions as $souscription) {
            if (!in_array($souscription->user->telephone, $phones)) {
                $souscription->user->notify(new SendSms(Auth::user(), $request->message));
                $phones[] = $souscription->user->telephone;
            }
        }
        notify()->info("Le traitement est terminé.");
        return back();
    }
}
