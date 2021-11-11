<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Souscription extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'programme_id',
        'montant',
        'profil_concerne_id'
    ];

    /**
     * Get the profilConcerne that owns the Souscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profilConcerne(): BelongsTo
    {
        return $this->belongsTo(ProfilConcerne::class);
    }
}
