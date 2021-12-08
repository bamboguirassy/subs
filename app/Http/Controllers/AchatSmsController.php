<?php

namespace App\Http\Controllers;

use App\Custom\Event;
use App\Custom\Helper;
use App\Custom\PaymentManager;
use App\Models\AchatSms;
use App\Models\AchatSmsTmp;
use App\Models\Facture;
use App\Models\PackSms;
use App\Models\Parametrage;
use App\Notifications\SendSms;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchatSmsController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packSms = PackSms::all();
        return view('sms.achat.new', compact('packSms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pack_sms_id' => 'exists:pack_sms,id'
        ]);
        DB::beginTransaction();
        try {
            $packSms = PackSms::find($request->get('pack_sms_id'));
            $achatSmsTmp = new AchatSmsTmp($request->all());
            $achatSmsTmp->nombreSms = $packSms->nombreSms;
            $achatSmsTmp->montant = $packSms->prix;
            $achatSmsTmp->user_id = Auth::id();
            $achatSmsTmp->uid = uniqid();
            $achatSmsTmp->save();
            notify("Vous avez acheté avec succès le forfait de {$packSms->nombreSms} SMS. <br>
            Votre solde actuel est de ".Auth::user()->nombreSms.' SMS');
            DB::commit();
            $url = PaymentManager::initSmsPayment($achatSmsTmp);
            return redirect()->away($url);
        } catch(Exception $e) {
            DB::rollback();
            notify()->error("une erreur est survenue pendant l'achat du pack SMS");
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AchatSms  $achatSms
     * @return \Illuminate\Http\Response
     */
    public function show(AchatSms $achatSms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AchatSms  $achatSms
     * @return \Illuminate\Http\Response
     */
    public function edit(AchatSms $achatSms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AchatSms  $achatSms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AchatSms $achatSms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AchatSms  $achatSms
     * @return \Illuminate\Http\Response
     */
    public function destroy(AchatSms $achatSms)
    {
        //
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
                $achatSmsTmp = AchatSmsTmp::where('uid', $uid)->first();
                if (!$achatSmsTmp) {
                    throw new Error("Aucun achat temp d'SMS trouvé pour le uid {$uid} n'est trouvée !");
                }
                $achatSms = Helper::convertTempAchatSms($achatSmsTmp);
                $achatSms->save();
                // recuperer toutes les autres souscriptions temp à ce program pour le meme user et supprimer
                $achatSmsTmps = AchatSmsTmp::where('user_id', $achatSmsTmp->user_id)
                    ->get();
                AchatSmsTmp::destroy($achatSmsTmps);
                $facture = new Facture();
                $facture->methodePaiement = $payment_method;
                $facture->clientPhone = $client_phone;
                $facture->libelle = $item_name;
                $facture->montant = $item_price;
                $facture->currency = $currency ?? 'xof';
                $facture->uid = $uid;
                $facture->achat_sms_id = $achatSms->id;
                $facture->save();
                $achatSms->user->notify(new SendSms(null,"Votre achat du pack SMS '{$achatSms->packSms->nom}' a reussi. ".config('app.name')));
                DB::commit();
                foreach (Parametrage::getInstance()->admins as $user) {
                    Event::dispatchUserEvent(Event::Message("Nouveau achat d'SMS","{$achatSms->user->name} a acheté des SMS : {$achatSms->packSms->nom}."),$user->id);
                }
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
        } else {
            // notifier de paiement sale_canceled
        }
    }
}
