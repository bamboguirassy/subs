<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametrage extends Model
{
    use HasFactory;

    protected $fillable = [
        'soldeSms',
        'tauxPrelevement'
    ];

    public static function getInstance(): Parametrage
    {
        $parametrages = Parametrage::all();
        if (count($parametrages) > 0) {
            return $parametrages[0];
        }
        $parametrage = new Parametrage(['soldeSms' => 0, 'tauxPrelevement' => 5]);
        if (!$parametrage->save()) {
            notify()->error("Une erreur est survenue lors de l'enregistrement du paramétre !!!");
        }
        return $parametrage;
    }

    public function getAdminsAttribute() {
        return User::where('type','admin')->get();
    }
}
