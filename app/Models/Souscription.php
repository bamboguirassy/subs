<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'programme_id',
        'montant',
        'profil_concerne_id'
    ];
}
