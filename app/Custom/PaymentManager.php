<?php

namespace App\Custom;

class PaymentManager
{

    public static function handlePayment($uid, $itemName, $price, $id = null)
    {
        $jsonResponse = (new PayTech(config('paytech.api.key'), config('paytech.api.secret')))->setQuery([
            'item_name' => $itemName,
            'item_price' => $price,
            'command_name' => "Paiement {$itemName} Gold via PayTech",
        ])->setCustomeField([
            'time_command' => time(),
            'ip_user' => $_SERVER['REMOTE_ADDR'],
            'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE']
        ])
            ->setTestMode(config('paytech.mode'))
            ->setCurrency('xof')
            ->setRefCommand($uid)
            ->setNotificationUrl([
                'ipn_url' => config('paytech.base.url') . '/ipn.php', //only https
                'success_url' => config('paytech.base.url') . '/paymentconfirmation?state=success&id=' . $id,
                'cancel_url' => config('paytech.base.url') . '/paymentconfirmation?state=cancel&id=' . $id
            ])->send();
        return $jsonResponse['redirect_url'];
    }
};
