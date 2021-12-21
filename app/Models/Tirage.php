<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tirage extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'souscription_id',
        'programme_id',
        'montant'
    ];


    /**
     * Get the souscription that owns the 2021_12_21_153837_create_tirages_table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function souscription(): BelongsTo
    {
        return $this->belongsTo(Souscription::class);
    }

    /**
     * Get the programme that owns the Tirage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }
}
