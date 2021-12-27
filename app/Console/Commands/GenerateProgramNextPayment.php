<?php

namespace App\Console\Commands;

use App\Models\Programme;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateProgramNextPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:program-next-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cette commande génére pour les programmes à paiements récurrents.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            /** gérer les programmes parents actifs */
            $programmeParents = Programme::where('dateDemarrage', today())
                ->where('programme_id', null)
                ->get();
            $programmeParents = $programmeParents->filter(function ($programme) {
                return in_array($programme->typeProgramme->code, ['COTIR', 'TONTINE']);
            });
            $this->comment("Programmes parents devant démarrer : " . count($programmeParents));
            foreach ($programmeParents as $programmeParent) {
                // créer uniquement pour les programmes n'ayant pas de children
                if (!$programmeParent->has_children && $programmeParent->nombre_main > 0) {
                    $this->comment("- {$programmeParent->nom} démarre aujourd'hui et a {$programmeParent->nombre_main} participant(s)...");
                    // creer le child
                    Programme::createChildFromParent($programmeParent);
                }
            }
            // recupérer les programmes enfants qui seront cloturées aujourd'hui
            $childrenPrograms = Programme::where('programme_id', '!=', null)
                ->where('dateCloture', today())
                ->get();
            $childrenPrograms = $childrenPrograms->filter(function ($programme) {
                return in_array($programme->typeProgramme->code, ['COTIR', 'TONTINE']);
            });
            $this->comment("Children programs arrivant à expiration : " . count($childrenPrograms));
            foreach ($childrenPrograms as $childProgram) {
                // si tontine, s'assurer que le current child n'a pas déja de suivant
                // pour ne pas récréer le child (il peut arriver que la date soit repoussée)
                if ($childProgram->is_tontine && !$childProgram->has_next && ($childProgram->parent->nombre_main != count($childProgram->parent->children))) {
                    Programme::createChildFromChild($childProgram);
                }
                // si cotisation récurrente, continuer à générer des enfants pour chaque enfants
                if ($childProgram->is_cotisation_recurrente && !$childProgram->parent->suspendu && ($childProgram->parent->nombre_main != count($childProgram->parent->children))) {
                    Programme::createChildFromChild($childProgram);
                }
                if (($childProgram->parent->nombre_main == count($childProgram->parent->children))) {
                    $this->comment("La tontine {$childProgram->parent->nom} est terminé aujourd'hui, il y'a {$childProgram->parent->nombre_main} main(s) et c'est la derniere tranche (id:{$childProgram->id}) qui est cloturée aujourd'hui...");
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        return Command::SUCCESS;
    }
}
