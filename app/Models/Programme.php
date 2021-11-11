<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get all of the souscriptions for the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function souscriptions(): HasMany
    {
        return $this->hasMany(Souscription::class);
    }
    
    /**
     * Get all of the profilConcernes for the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profilConcernes(): HasMany
    {
        return $this->hasMany(ProfilConcerne::class);
    }

    /**
     * Get the typeProgramme that owns the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeProgramme(): BelongsTo
    {
        return $this->belongsTo(TypeProgramme::class);
    }
    
    /**
     * Get the user that owns the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getActiveAttribute() {
        return now()>$this->dateCloture();
    }
}
