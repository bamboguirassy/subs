<?php

namespace App\Models;

use App\Mail\GenerateTontineTranche;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Programme extends Model
{
    use HasFactory;

    public const FREQUENCE_HEBDO = 'hebdomadaire';
    public const FREQUENCE_MENSUEL = 'mensuelle';
    public const FREQUENCE_PAR_DIZAINE = 'par 10 jours';

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
        'user_id',
        'montant',
        'frequence',
        'programme_id',
        'tranche',
        'tauxPrelevement',
        'nombreMainMaxPersonne'
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
     * Get all of the souscriptionTemps for the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function souscriptionTemps(): HasMany
    {
        return $this->hasMany(SouscriptionTemp::class);
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

    /**
     * Get all of the children for the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Programme::class);
    }

    /**
     * Get the parent that owns the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Programme::class, 'programme_id');
    }

    /**
     * Get the lastChild associated with the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastChild(): HasOne
    {
        return $this->hasOne(Programme::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the appelFond associated with the Programme
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function appelFond(): HasOne
    {
        return $this->hasOne(AppelFond::class);
    }

    public function getGainAttribute()
    {
        $total = 0;
        foreach ($this->souscriptions as $souscription) {
            $total += $souscription->montant;
        }
        return $total;
    }

    public function getGainNetAttribute()
    {
        $total = 0;
        foreach ($this->souscriptions as $souscription) {
            $total += $souscription->montant;
        }
        $prelevementPercent = (100 - $this->tauxPrelevement) / 100;
        return  $prelevementPercent * $total;
    }

    public function getHasChildrenAttribute()
    {
        return count($this->children) > 0;
    }

    public function getNombreMainAttribute()
    {
        if ($this->typeProgramme->code == 'TONTINE') {
            if ($this->nombreParticipants > 0) {
                return $this->nombreParticipants;
            } else {
                return $this->souscriptions->sum('nombreMain');
            }
        }
        return 0;
    }

    public function getNombreMainSouscriteAttribute()
    {
        if ($this->typeProgramme->code == 'TONTINE') {
            return $this->souscriptions->sum('nombreMain');
        }
        return 0;
    }

    public function getIsProprietaireAttribute()
    {
        if (Auth::check()) {
            if (Auth::id() == $this->user_id || Auth::user()->type == 'admin') {
                return true;
            }
        }
        return false;
    }

    public function getActiveAttribute()
    {
        return $this->dateCloture >= date_format(new DateTime(), 'Y-m-d');
    }

    public function getCurrentUserSouscriptionAttribute(): ?Souscription
    {
        if (Auth::check()) {
            $souscriptions = Souscription::where('user_id', Auth::id())
                ->where('programme_id', $this->id)
                ->get();
            return count($souscriptions) > 0 ? $souscriptions[0] : null;
        }
        return null;
    }

    public function getIsParentAttribute()
    {
        return $this->programme_id == null;
    }

    public function getIsChildAttribute()
    {
        return $this->programme_id != null;
    }

    /**
     * cette fonction retourne la progression des cotisations pour les programmes enfants
     * La progression est le nombre de participants fils sur le nombre de souscriptions parents
     */
    public function getProgressionAttribute()
    {
        if ($this->is_child && count($this->parent->souscriptions) > 0) {
            return (count($this->souscriptions) * 100) / count($this->parent->souscriptions);
        }
        return null;
    }

    public function getIsPublicAttribute()
    {
        return $this->typeProgramme->code == "PROG" || $this->typeProgramme->code == "CFON";
    }

    public function getIsCollecteFondAttribute()
    {
        return $this->typeProgramme->code == "CFON";
    }

    public function getIsCotisationAttribute()
    {
        return $this->typeProgramme->code == "COTI";
    }

    public function getIsProgrammeAttribute()
    {
        return $this->typeProgramme->code == "PROG";
    }

    public function getIsTontineAttribute()
    {
        return $this->typeProgramme->code == "TONTINE";
    }

    public function getHasNextAttribute()
    {
        if ($this->programme_id != null) {
            $nextPrograms = Programme::whereProgrammeId($this->programme_id)
                ->whereTranche($this->tranche + 1)
                ->get();
            return count($nextPrograms) > 0;
        }
        return false;
    }

    /**
     * Créer un programme enfant à partir de la tontine principale
     * Cette méthode est appelée uniquement à la date de démarrage de la tontine et créé le premier child
     */
    public static function createChildFromParent(Programme $parent)
    {
        $programme = new Programme();
        $programme->programme_id = $parent->id;
        $programme->type_programme_id = $parent->type_programme_id;
        $index = count($parent->children) + 1;
        $programme->nom = 'Tranche ' . $index;
        $programme->tranche = $index;
        $programme->montant = $parent->montant;
        $programme->nombreParticipants = 0;
        $programme->frequence = $parent->frequence;
        $programme->description = $parent->description;
        $programme->image = $parent->image;
        $programme->user_id = $parent->user_id;
        $programme->nombreParticipants = $parent->nombre_main;
        $programme->dateDemarrage = today();
        if ($parent->frequence == Programme::FREQUENCE_HEBDO) {
            $programme->dateCloture = today()->addWeek();
        } else if ($parent->frequence == Programme::FREQUENCE_MENSUEL) {
            $programme->dateCloture = today()->addMonth();
        } else if ($parent->frequence == Programme::FREQUENCE_PAR_DIZAINE) {
            $programme->dateCloture = today()->addDays(10);
        }
        $programme->save();
        Programme::notifyTontinePayment($programme, $parent->souscriptions);
    }

    /**
     * Créer un programme child à partir d'un child
     * Lorsqu'une tranche de la tontine est terminée, la tranche suivante est générée
     */
    public static function createChildFromChild(Programme $child)
    {
        $programme = new Programme();
        $programme->programme_id = $child->parent->id;
        $programme->type_programme_id = $child->type_programme_id;
        $index = count($child->parent->children) + 1;
        $programme->nom = 'Tranche ' . $index;
        $programme->tranche = $index;
        $programme->montant = $child->parent->montant;
        $programme->nombreParticipants = 0;
        $programme->frequence = $child->parent->frequence;
        $programme->description = $child->parent->description;
        $programme->image = $child->parent->image;
        $programme->user_id = $child->parent->user_id;
        $programme->nombreParticipants = $child->parent->nombre_main;
        $programme->dateDemarrage = today();
        if ($child->parent->frequence == Programme::FREQUENCE_HEBDO) {
            $programme->dateCloture = today()->addWeek();
        } else if ($child->parent->frequence == Programme::FREQUENCE_MENSUEL) {
            $programme->dateCloture = today()->addMonth();
        } else if ($child->parent->frequence == Programme::FREQUENCE_PAR_DIZAINE) {
            $programme->dateCloture = today()->addDays(10);
        }
        $programme->save();
        Programme::notifyTontinePayment($programme, $child->parent->souscriptions);
    }

    public static function notifyTontinePayment(Programme $programme, $souscriptions)
    {
        foreach ($souscriptions as $souscription) {
            // envoyer mail au particpant avec les détails du paiement et rappel
            Mail::to($souscription->user)->send(new GenerateTontineTranche($programme, $souscription));
        }
    }
}
