<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppelFond extends Model
{
    use HasFactory;

    protected $fillable = [
        'methodePaiement',
        'mobilePaiement',
        'montant',
        'traite',
        'rejete',
        'dateTraitement',
        'observation',
        'programme_id',
        'user_id'
    ];

    /**
     * Get the user that owns the AppelFond
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }

    /**
     * Get the programme that owns the AppelFond
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }
}
