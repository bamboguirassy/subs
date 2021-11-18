<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Get the user that owns the SouscriptionTemp
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
