<?php

namespace App\Console\Commands;

use App\Models\Programme;
use Illuminate\Console\Command;

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
        $createdPrograms = [];
        /** gérer les programmes parents actifs */
        $programmeParents = Programme::whereRelation('typeProgramme', 'code', 'TONTINE')
            ->where('dateDemarrage', today())
            ->where('programme_id', null)
            ->get();
        foreach ($programmeParents as $programmeParent) {
            // créer uniquement pour les programmes n'ayant pas de children
            if (!$programmeParent->has_children && $programmeParent->nombre_main) {
                // creer le child
                $createdPrograms[] = Programme::createChildFromParent($programmeParent);
            }
        }
        // recupérer les programmes enfants qui seront cloturées aujourd'hui
        $childrenPrograms = Programme::whereRelation('typeProgramme', 'code', 'TONTINE')
            ->where('programme_id', '!=', null)
            ->where('dateCloture', today())
            ->get();
        foreach ($childrenPrograms as $childProgram) {
            /** vérifier si le nombre de main n'est pas fini */
            $createdPrograms[] = Programme::createChildFromChild($childProgram);
        }
        return Command::SUCCESS;
    }
}
