<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>Rule::unique('users','email')->ignore($user->id),
            'telephone'=>'required',
            'profession'=>'required',
            'presentation'=>'required'
        ]);

        DB::beginTransaction();
        try {
            if ($request->has('photo')) {
                Storage::delete('users/photos' . $user->image);
                $photoname = $request->get('email') . '.' . $request->file('photo')->extension();
                $request->file('photo')->storeAs('users/photos', $photoname);
                $user->photo = $photoname;
            }
            $user->update($request->except('photo'));
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        notify()->success("Le profil a bien été Modifier !!!");
        return back();
    }


}
