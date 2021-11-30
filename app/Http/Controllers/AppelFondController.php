<?php

namespace App\Http\Controllers;

use App\Mail\AdviseNewAppelFond;
use App\Models\AppelFond;
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
        $appelFonds = AppelFond::orderBy('traite','desc')->orderBy('created_at','desc')->get();
        return view('admin.appelfond.list',compact('appelFonds'));
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
            'programme_id'=>'required|exists:programmes,id',
            'methodePaiement'=>'required',
            'mobilePaiement'=>'required',
            'montant'=>'required'
        ]);
        $appelFond = new AppelFond($request->all());
        $appelFond->user_id = Auth::id();
        if($appelFond->save()) {
            notify("L'appel de fond a passé, vous serez contactés pour la suite...");
            Mail::to(config('mail.cc'))->send(new AdviseNewAppelFond($appelFond));
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
    public function update(Request $request, AppelFond $appelFond)
    {
        //
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
