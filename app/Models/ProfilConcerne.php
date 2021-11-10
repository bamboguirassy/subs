<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilConcerne extends Model
{
    use HasFactory;

    protected $fillable = [
        'profil_id',
        'programme_id',
        'montant'
    ];
}
