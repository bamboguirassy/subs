<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AchatSmsTmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreSms',
        'montant',
        'user_id',
        'pack_sms_id',
        'confirmed',
        'uid',
    ];

    /**
     * Get the packSms that owns the AchatSms
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function packSms(): BelongsTo
    {
        return $this->belongsTo(PackSms::class);
    }

    /**
     * Get the user that owns the AchatSmsTmp
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
