<?php

namespace App\Http\Controllers;

use App\Custom\Helper;
use App\Custom\PaymentManager;
use App\Mail\PaymentBodySend;
use App\Models\Facture;
use App\Models\ProfilConcerne;
use App\Models\Programme;
use App\Models\Souscription;
use App\Models\SouscriptionTemp;
use App\Models\User;
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
            'profil_concerne_id' => 'required|exists:profil_concernes,id',
            'programme_id' => 'required|exists:programmes,id',
        ]);
        // démarrer la transaction
        DB::beginTransaction();
        try {
            $programme = Programme::find($request->get('programme_id'));
            // vérifier si user n'a pas déja souscrit
            if ($programme->current_user_souscription) {
                notify()->warning("Vous avez déja souscrit à ce programme !");
                return redirect()->route('programme.show', compact('programme'));
            }
            // verifier si l'utilisateur est connecté
            if (Auth::check()) {
                // si user connecté, associer le programme à l'utilisateur connecté
                $userId = Auth::id();
            } else {
                $userVerif = User::where('email', $request->get('email'))
                    ->first();
                if ($userVerif) {
                    $warningMessage = "Cette adresse email est déja utilisée par un autre compte, si c'est la votre, merci de vous connecter avec votre compte. <a href='" . route('login') . "?ret=" . URL::previous() . "'>Se connecter</a>";
                    notify()->warning($warningMessage);
                    return back()->withErrors([$warningMessage])->withInput();
                }
                // si user non connecté, valider le formulaire avec les infos user du formulaire
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|unique:users,email',
                    'profession' => 'required',
                    'telephone' => 'required',
                    'password' => 'confirmed|min:6',
                    'photo' => 'required|image'
                ]);
                // créer le user dans la DB et l'associer au programme
                $user = new User($request->all());
                $password = Hash::make($request->get('password'));
                $user->password = $password;
                // gérer upload image
                $photoname = $user->email . '_' . uniqid() . '.' . $request->file('photo')->extension();
                $request->file('photo')->storeAs('users/photos', $photoname);
                $user->photo = $photoname;
                $user->save();
                /** notofier l'utilisateur pour le compte */
                $userId = $user->id;
            }
            // recuperer le profil selectionné
            $profilConcerne = ProfilConcerne::find($request->get('profil_concerne_id'));
            // recuperer le profil concerne et verifier si le paiement est gratuit
            if ($profilConcerne->montant == 0) {
                // convert temp souscription to souscription
                $souscription = new Souscription($request->all());
                $souscription->user_id = $userId;
                $souscription->montant = 0;
                $souscription->uid = uniqid();
                $souscription->save();
                notify()->success("Vous avez souscrit avec succès au programme !!!");
            } else {
                // instancier la souscription temp avec le contenu du request
                $souscriptionTemp = new SouscriptionTemp($request->all());
                $souscriptionTemp->uid = uniqid();
                $souscriptionTemp->user_id = $userId;
                $souscriptionTemp->montant = $profilConcerne->montant;
                $souscriptionTemp->save();
                // terminer la transaction
                $redirectUrl = PaymentManager::initPayment($souscriptionTemp, $profilConcerne);
            }
            DB::commit();
            if (!Auth::check()) {
                if (Auth::attempt($request->only('email', 'password'))) {
                    notify()->success("Vous êtes connecté à  votre compte !");
                }
            }
            // gérer le paiement par paytech
            return $profilConcerne->montant > 0 ? redirect()->to($redirectUrl) : redirect()->route('programme.show', compact('programme'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        Mail::to(config('mail.cc'))->send(new PaymentBodySend(json_encode($request->input())));
        $type_event = $request->input('type_event');
        $payment_method = $request->input('payment_method');
        $client_phone = $request->input('client_phone');
        $uid = $request->input('ref_command');
        $item_name = $request->input('item_name');
        $item_price = $request->input('item_price');
        $currency = $request->input('devise');

        $facture = new Facture();
        //from PayTech
        if ($type_event == 'sale_complete') {
            DB::beginTransaction();
            try {
                // recuperer la souscription temp
                $souscriptionTemp = SouscriptionTemp::where('uid', $uid)->first();
                if(!$souscriptionTemp) {
                    throw new Error("Aucune souscription pour le uid {$uid} n'est trouvée !");
                }
                $souscription = Helper::convertTempSouscription($souscriptionTemp);
                $souscription->save();
                // recuperer toutes les autres souscriptions temp à ce program pour le meme user et supprimer
                $souscriptionTemps = SouscriptionTemp::where('programme_id', $souscriptionTemp->programme_id)
                    ->where('user_id', $souscriptionTemp->user_id)
                    ->get();
                SouscriptionTemp::destroy($souscriptionTemps);
                $facture->methodePaiement = $payment_method;
                $facture->clientPhone = $client_phone;
                $facture->libelle = $item_name;
                $facture->montant = $item_price;
                $facture->currency = $currency;
                $facture->uid = $uid;
                $facture->souscription_id = $souscription->id;
                $facture->save();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
        } else {
            // notifier de paiement sale_canceled
        }
    }
}
