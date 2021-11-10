<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\ProfilConcerne;
use App\Models\Programme;
use App\Models\TypeProgramme;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'type_programme_id'=>'required|exists:type_programmes,id',
            'nom'=>'required',
            'dateCloture'=>'required',
            'dateDemarrage'=>'required',
            'duree'=>'required',
            'nombreSeance'=>'required|numeric',
            'nombreParticipants'=>'required|numeric',
            'description'=>'required',
            'modeDeroulement'=>'required',
            'image'=>'image|required',
            'profils'=>'array|required',
            'cout'=>'array|required'
        ]);
//    --     démarrer la transaction
        DB::beginTransaction();
        try {
        // instancier le programme avec le contenu du request
        $programme = new Programme($request->all());
        //gérer l'upload de l'image de couverture
        $filename = $programme->nom.'_'.uniqid().'.'.$request->file('image')->extension();
        $request->file('image')->storeAs('programmes/images',$filename);
        $programme->image = $filename;
        // verifier si l'utilisateur est connecté
        if(Auth::check()) {
            // si user connecté, associer le programme à l'utilisateur connecté
            $programme->user_id = Auth::id();
        } else {
            // si user non connecté, valider le formulaire avec les infos user du formulaire
            $request->validate([
                'name'=>'required',
                'email'=>'required|unique:users,email',
                'profession'=>'required',
                'presentation'=>'required',
                'password'=>'confirmed|min:6',
                'photo'=>'required|image'
            ]);
            // créer le user dans la DB et l'associer au programme
            $user = new User($request->all());
            $password = Hash::make($request->get('password'));
            $user->password = $password;
            // gérer upload image
            $photoname = $user->email.'_'.uniqid().'.'.$request->file('photo')->extension();
            $request->file('photo')->storeAs('users/photos',$photoname);
            $user->photo = $photoname;
            $user->save();
            /** notofier l'utilisateur pour le compte */
            $programme->user_id = $user->id;
        }
        $programme->save();

        // reccuperer les profils selectionnés
        foreach ($request->get('profils') as $profilId) {
            // et créer les profils concernés avec les montants et les associer avec le programme
            $profilConcerne = new ProfilConcerne([
                'profil_id'=>$profilId,
                'programme_id'=>$programme->id,
                'montant'=>$request->get('cout')[$profilId]
            ]);
            $profilConcerne->save();
        }
        //      -- terminer la transaction
        DB::commit();
        notify()->success("Le programme a bien été enregistré !!!");
        if(!Auth::check()) {
            if(Auth::attempt($request->only('email','password'))) {
                notify()->success("Vous êtes connecté à  votre compte !");
            }
        }
        return redirect()->route('programme.show',compact('programme'));
        } catch(Exception $e) {
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
