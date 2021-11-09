<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Programme;
use App\Models\TypeProgramme;
use Illuminate\Http\Request;

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
    public function create()
    {
        $typeProgrammes = TypeProgramme::orderBy('nom')->get();
        $profils = Profil::orderBy('nom')->get();
        return view('programme.new',compact('typeProgrammes','profils'));
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
        
//    --     démarrer la transaction

        // instancier le programme avec le contenu du request
        //gérer l'upload de l'image de couverture
        
        // verifier si l'utilisateur est connecté
        // si user connecté, associer le programme à l'utilisateur connecté
        // si user non connecté, valider le formulaire avec les infos user du formulaire
        // créer le user dans la DB et l'associer au programme

        // reccuperer les profils selectionnés
        // et créer les profils concernés avec les montants et les associer avec le programme

        //      -- terminer la transaction


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        return view('programme.show',compact('programme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        return view('programme.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        //
    }
}
