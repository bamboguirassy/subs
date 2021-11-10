<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_programme_id',
        'nom',
        'dateCloture',
        'dateDemarrage',
        'duree',
        'nombreSeance',
        'nombreParticipants',
        'description',
        'modeDeroulement',
        'image',
        'user_id'
    ];
}
