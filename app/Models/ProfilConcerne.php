<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilConcerne extends Model
{
    use HasFactory;

    protected $fillable = [
        'profil_id',
        'programme_id',
        'montant'
    ];

    /**
     * Get the profil that owns the ProfilConcerne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profil(): BelongsTo
    {
        return $this->belongsTo(Profil::class);
    }
}
