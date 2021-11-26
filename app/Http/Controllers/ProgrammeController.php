<?php

namespace App\Http\Controllers;

use App\Custom\Helper;
use App\Models\Profil;
use App\Models\ProfilConcerne;
use App\Models\Programme;
use App\Models\SouscriptionTemp;
use App\Models\TypeProgramme;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;
use PragmaRX\Countries\Package\Countries;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programme.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->exists('type')) {
            $request->validate(['type'=>'exists:type_programmes,code']);
            $typeProgramme = TypeProgramme::whereCode($request->get('type'))->first();
        } else {
            $typeProgramme = TypeProgramme::whereCode('PROG')->first();
        }
        $profils = Profil::orderBy('nom')->get();
        $countrieSrv = new Countries();
        $senegal = $countrieSrv->where('cca2', 'SN')->first();
        return view('programme.new', compact('profils','senegal','typeProgramme'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valider les champs obligatoires propres à programme
        $request->validate([
            'type_programme_id' => 'required|exists:type_programmes,id'
        ]);
        $typeProgramme = TypeProgramme::find($request->get('type_programme_id'));
        if($typeProgramme->code=='COTI') {
            $this->validateCotisation();
        } else if($typeProgramme->code=='LFON') {
            $this->validateLeveeFond();
        } else if($typeProgramme->code=='PROG') {
            $this->validateProgramme();
        } else if($typeProgramme->code=='TONTINE') {
            $this->validateTontine();
        }
        //    --     démarrer la transaction
        DB::beginTransaction();
        try {
            // instancier le programme avec le contenu du request
            $programme = new Programme($request->all());
            //gérer l'upload de l'image de couverture
            $filename = $programme->nom . '_' . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('programmes/images', $filename);
            $programme->image = $filename;
            // verifier si l'utilisateur est connecté
            if (Auth::check()) {
                // si user connecté, associer le programme à l'utilisateur connecté
                $programme->user_id = Auth::id();
            } else {
                // forcer la validation de présentation pour le formateur ou responsable de programme
                $request->validate([
                    'presentation' => 'required'
                ]);
                $user = Helper::createUserFromRequest();
                if ($user == null) {
                    return back()->withInput();
                }
                $programme->user_id = $user->id;
            }
            $programme->save();

            // reccuperer les profils selectionnés
            foreach ($request->get('profils') as $profilId) {
                // et créer les profils concernés avec les montants et les associer avec le programme
                $profilConcerne = new ProfilConcerne([
                    'profil_id' => $profilId,
                    'programme_id' => $programme->id,
                    'montant' => $request->get('cout')[$profilId]
                ]);
                $profilConcerne->save();
            }
            //      -- terminer la transaction
            DB::commit();
            notify()->success("Le programme a bien été enregistré !!!");
            if (!Auth::check()) {
                if (Auth::attempt($request->only('email', 'password'))) {
                    notify()->success("Vous êtes connecté à  votre compte !");
                }
            }
            return redirect()->route('programme.show', compact('programme'));
        } catch (Exception $e) {
            notify()->error("Une erreur s'est produite pendant l'enregistrement du programme, merci de réssayer !");
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        return view('programme.show', compact('programme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        $typeProgrammes = TypeProgramme::orderBy('nom')->get();
        $profils = Profil::orderBy('nom')->get();
        return view('programme.edit', compact('typeProgrammes', 'profils', 'programme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        $request->validate([
            'type_programme_id' => 'required|exists:type_programmes,id',
            'nom' => 'required',
            'dateCloture' => 'required',
            'dateDemarrage' => 'required',
            'duree' => 'required',
            'nombreSeance' => 'required|numeric',
            'nombreParticipants' => 'required|numeric',
            'description' => 'required',
            'modeDeroulement' => 'required',
        ]);

        DB::beginTransaction();
        try {
            if ($request->has('image')) {
                Storage::delete('programmes/images/' . $programme->image);
                $filename = $request->get('nom') . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('programmes/images', $filename);
                $programme->image = $filename;
            }
            $programme->update($request->except('image'));
            DB::commit();
            notify()->success("Le programme a bien été Modifier !!!");
            return redirect()->route('programme.show', compact('programme'));
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        if (count($programme->souscriptions) > 0) {
            notify()->warning("Ce programmes a des participants, impossible de procéder à sa suppression !");
            return back();
        }
        DB::beginTransaction();
        try {
            SouscriptionTemp::destroy($programme->souscriptionTemps);
            ProfilConcerne::destroy($programme->profilConcernes);
            if ($programme->delete()) {
                notify("Suppression reussie !");
                Storage::delete(['programmes/images/' . $programme->image]);
            } else {
                notify()->error("Une erreur est survenue lors de la suppression du programme !");
            }
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->route('mes.programmes');
    }

    function validateProgramme() {
        // valider les champs obligatoires propres à programme
        request()->validate([
            'type_programme_id' => 'required|exists:type_programmes,id',
            'nom' => 'required',
            'dateCloture' => 'required',
            'dateDemarrage' => 'required',
            'duree' => 'required',
            'nombreSeance' => 'required|numeric',
            'nombreParticipants' => 'required|numeric',
            'description' => 'required',
            'modeDeroulement' => 'required',
            'image' => 'image|required',
            'profils' => 'array|required',
            'cout' => 'array|required'
        ]);
    }

    function validateCotisation() {
        // valider les champs obligatoires propres à programme
        request()->validate([
            'type_programme_id' => 'required|exists:type_programmes,id',
            'nom' => 'required',
            'dateCloture' => 'required',
            'description' => 'required',
            'montant'=>'required',
        ]);
    }

    function validateTontine() {
        // valider les champs obligatoires propres à programme
        request()->validate([
            'type_programme_id' => 'required|exists:type_programmes,id',
            'nom' => 'required',
            'dateCloture' => 'required',
            'description' => 'required',
            'montant'=>'required',
            'frequence'=>'required|in_array:journalière,hebdomadaire,mensuelle',
            'dateLimitePremierPaiement'=>'required'
        ]);
    }

    function validateLeveeFond() {
        // valider les champs obligatoires propres à programme
        request()->validate([
            'type_programme_id' => 'required|exists:type_programmes,id',
            'nom' => 'required',
            'dateCloture' => 'required',
            'description' => 'required',
        ]);
    }
}
