<?php

namespace App\Custom;

use App\Models\ProfilConcerne;
use App\Models\SouscriptionTemp;
use Error;

class PaymentManager
{

    public static function initPayment(SouscriptionTemp $souscriptionTemp)
    {
        $jsonResponse = (new PayTech(config('paytech.api.key'), config('paytech.api.secret')))->setQuery([
            'item_name' => $souscriptionTemp->programme->nom,
            'item_price' => $souscriptionTemp->montant,
            'command_name' => "Paiement {$souscriptionTemp->programme->nom}",
        ])->setCustomeField([
            'time_command' => time(),
            'ip_user' => $_SERVER['REMOTE_ADDR'],
            'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE']
        ])
            ->setTestMode(config('paytech.mode'))
            ->setCurrency('xof')
            ->setRefCommand($souscriptionTemp->uid)
            ->setNotificationUrl([
                'ipn_url' => config('paytech.base.url') . '/souscription_pin', //only https
                'success_url' => config('paytech.base.url') . '/paymentconfirmation?state=success&id=' . $souscriptionTemp->id,
                'cancel_url' => config('paytech.base.url') . '/paymentconfirmation?state=cancel&id=' . $souscriptionTemp->id
            ])->send();
        if ($jsonResponse['success'] == 1) {
            return $jsonResponse['redirect_url'];
        }
        throw new Error("Une erreur est survenue lors de la connexion avec la plateforme de paiement...");
    }
};
