<?php
namespace App\Custom;

use App\Models\Souscription;
use App\Models\SouscriptionTemp;


class Helper {
    public static function convertTempSouscription(SouscriptionTemp $souscriptionTemp): Souscription {
        $souscription = new Souscription();
        $souscription->profil_concerne_id = $souscriptionTemp->profil_concerne_id;
        $souscription->montant = $souscriptionTemp->montant;
        $souscription->uid = $souscriptionTemp->uid;
        $souscription->user_id = $souscriptionTemp->user_id;
        $souscription->programme_id = $souscriptionTemp->programme_id;
        return $souscription;
    }
}
