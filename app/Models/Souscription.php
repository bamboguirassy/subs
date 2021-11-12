<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Souscription extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'programme_id',
        'montant',
        'profil_concerne_id',
        'uid'
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

    /**
     * Get the programme that owns the Souscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }

    /**
     * Get the facture associated with the Souscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    /**
     * Get the user that owns the Souscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
