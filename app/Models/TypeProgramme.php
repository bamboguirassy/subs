<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProgramme extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'image',
        'icon',
        'description',
        'enabled'
    ];
}
