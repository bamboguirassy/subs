<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    public const ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profession',
        'presentation',
        'telephone',
        'photo',
        'country_cca2',
        'type',
        'nombreSms'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The programmeSouscrits that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function programmeSouscrits(): BelongsToMany
    {
        return $this->belongsToMany(Programme::class, 'souscriptions')->orderBy('created_at','desc');
    }

    public function getMainSubscribedProgramsAttribute()
    {
        return Programme::whereRelation('souscriptions', function ($query) {
            return $query->where('user_id', $this->id);
        })->where('programme_id', null)->orderBy('created_at','desc')->get();
    }

    /**
     * Get all of the programmes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programmes(): HasMany
    {
        return $this->hasMany(Programme::class)->where('programme_id', null)->orderBy('created_at','desc');
    }

    /**
     * Get all of the appelFonds for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function appelFonds(): HasManyThrough
    {
        return $this->hasManyThrough(AppelFond::class, Programme::class)->orderBy('created_at','desc');
    }

    /**
     * Get all of the achatSmsList for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function achatSmsList(): HasMany
    {
        return $this->hasMany(AchatSms::class)->whereConfirmed(true)->orderBy('created_at','desc');
    }

    public function getIsAdminAttribute()
    {
        return $this->type == User::ADMIN;
    }
}
