<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SouscriptionTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'profil_concerne_id',
        'montant',
        'methodePaiement',
        'uid',
        'user_id',
        'programme_id'
    ];
}
