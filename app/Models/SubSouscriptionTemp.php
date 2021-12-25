<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubSouscriptionTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'souscription_temp_id',
        'programme_id',
        'montant'
    ];

    /**
     * Get the souscriptionTemp that owns the SubSouscriptionTemp
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function souscriptionTemp(): BelongsTo
    {
        return $this->belongsTo(SouscriptionTemp::class);
    }

    /**
     * Get the programme that owns the SubSouscriptionTemp
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }
}
