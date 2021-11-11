<?php

namespace App\Http\Controllers;

use App\Models\Souscription;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SouscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'profil_concerne_id'=>'required|exists:profil_concernes,id',
            'programme_id'=>'required|exists:programmes,id',
        ]);
//    --     démarrer la transaction
        DB::beginTransaction();
        try {
        // instancier le programme avec le contenu du request
        $souscription = new Souscription($request->all());

        // verifier si l'utilisateur est connecté
        if(Auth::check()) {
            // si user connecté, associer le programme à l'utilisateur connecté
            $souscription->user_id = Auth::id();
        } else {
            // si user non connecté, valider le formulaire avec les infos user du formulaire
            $request->validate([
                'name'=>'required',
                'email'=>'required|unique:users,email',
                'profession'=>'required',
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
            $souscription->user_id = $user->id;
        }
        $souscription->save();
        //      -- terminer la transaction
        DB::commit();
        if(!Auth::check()) {
            if(Auth::attempt($request->only('email','password'))) {
                notify()->success("Vous êtes connecté à  votre compte !");
            }
        }
        // recuperer le profil selectionné
        $profilConcerne = $souscription->profilConcerne;
        if($profilConcerne->montant==0) {
            notify()->success("Vous avez souscrit avec succès à ce programme !!!");
        } else {
            // recuperer le tocken de paiement de paytech et rediriger vers le user
        }
        return redirect()->route('programme.show',compact('programme'));
        } catch(Exception $e) {
            notify()->error("Une erreur s'est produite pendant la souscription, merci de réssayer !");
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
