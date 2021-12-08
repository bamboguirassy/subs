<?php

namespace App\Http\Controllers;

use App\Custom\Event;
use App\Mail\AdviseNewAppelFond;
use App\Models\AppelFond;
use App\Models\Parametrage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppelFondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appelFonds = AppelFond::orderBy('created_at', 'desc')->get();
        return view('admin.appelfond.list', compact('appelFonds'));
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
        $request->validate([
            'programme_id' => 'required|exists:programmes,id',
            'methodePaiement' => 'required',
            'mobilePaiement' => 'required',
            'montant' => 'required'
        ]);
        $appelFond = new AppelFond($request->all());
        $appelFond->user_id = Auth::id();
        if ($appelFond->save()) {
            notify("L'appel de fond a passé, vous serez contactés pour la suite...");
            Mail::to(config('mail.cc'))->send(new AdviseNewAppelFond($appelFond));
            foreach (Parametrage::getInstance()->admins as $user) {
                Event::dispatchUserEvent(Event::Message("Nouvel appel de fond", Auth::user()->name." a fait un appel de fond d'une valeur de {$appelFond->montant}."), $user->id);
            }
        } else {
            notify()->error("Une erreur est survenue lors de l'appel de fond, merci de réssayer");
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppelFond  $appelFond
     * @return \Illuminate\Http\Response
     */
    public function show(AppelFond $appelFond)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppelFond  $appelFond
     * @return \Illuminate\Http\Response
     */
    public function edit(AppelFond $appelFond)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppelFond  $appelFond
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppelFond $appelfond)
    {
        $request->validate([
            'etat' => 'required',
            'frais'=>'required_if:etat,Traité'
        ]);
        $etats = ["En attente", "En cours", "Traité"];
        if (!in_array($request->etat, $etats)) {
            notify()->error("La valeur de état n'est pas reconnue !!!");
        } else {
            $appelfond->dateTraitement = now();
            $appelfond->user_id = Auth::id();
            if ($request->etat == 'En cours') {
                $message = "Votre appel de fond pour le programme '{$appelfond->programme->nom}' est en cours de traitement.";
            } else if ($request->etat == 'Traité') {
                if($request->exists('frais')) {
                    if($request->frais>=$appelfond->montant) {
                        notify()->error("Les frais ne peuvent être supérieurs ou égaux au montant, merci de revoir la valeur saisie.");
                        return back();
                    }
                }
                $message = "Votre appel de fond pour le programme '{$appelfond->programme->nom}' est traité.";
            } else {
                $message = "Votre appel de fond pour le programme '{$appelfond->programme->nom}' est en attente.";
            }
            $appelfond->update($request->all());
            Event::dispatchUserEvent(Event::Message("Changement etat : Appel de fond", $message), $appelfond->programme->user_id);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppelFond  $appelFond
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppelFond $appelFond)
    {
        //
    }
}
