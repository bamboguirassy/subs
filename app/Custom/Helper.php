<?php

namespace App\Custom;

use App\Models\AchatSms;
use App\Models\AchatSmsTmp;
use App\Models\Souscription;
use App\Models\SouscriptionTemp;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class Helper
{
    public static function convertTempSouscription(SouscriptionTemp $souscriptionTemp): Souscription
    {
        $souscription = new Souscription();
        $souscription->profil_concerne_id = $souscriptionTemp->profil_concerne_id;
        $souscription->montant = $souscriptionTemp->montant;
        $souscription->uid = $souscriptionTemp->uid;
        $souscription->user_id = $souscriptionTemp->user_id;
        $souscription->programme_id = $souscriptionTemp->programme_id;
        return $souscription;
    }

    public static function convertTempAchatSms(AchatSmsTmp $achatSmsTmp): AchatSms
    {
        $achatSms = new AchatSms();
        $achatSms->user_id = $achatSmsTmp->user_id;
        $achatSms->confirmed = true;
        $achatSms->montant = $achatSmsTmp->montant;
        $achatSms->nombreSms = $achatSmsTmp->nombreSms;
        $achatSms->uid = $achatSmsTmp->uid;
        $achatSms->pack_sms_id = $achatSmsTmp->pack_sms_id;
        $achatSms->user->nombreSms+=$achatSms->nombreSms;
        $achatSms->user->update();
        return $achatSms;
    }

    public static function createUserFromRequest(): ?User
    {
        $request = request();
        $userVerif = User::where('email', $request->get('email'))
            ->first();
        if ($userVerif) {
            $warningMessage = "Cette adresse email est déja utilisée par un autre compte, si c'est la votre, merci de vous connecter avec votre compte. <a href='" . route('login') . "?ret=" . URL::previous() . "'>Se connecter</a>";
            notify()->warning($warningMessage);
            return null;
        }
        // si user non connecté, valider le formulaire avec les infos user du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'profession' => 'required',
            'telephone' => 'required|starts_with:+|min:9',
            'password' => 'confirmed|min:6'
        ]);
        // créer le user dans la DB et l'associer au programme
        $user = new User($request->all());
        $user->telephone = str_replace(' ', '', $request->telephone);
        $user->telephone = trim($request->telephone);
        $password = Hash::make($request->get('password'));
        $user->password = $password;
        // gérer upload image
        if ($request->hasFile('image')) {
            $photoname = $user->email . '_' . uniqid() . '.' . $request->file('photo')->extension();
            $request->file('photo')->storeAs('users/photos', $photoname);
            $user->photo = $photoname;
        }
        $user->save();
        $user->notify(new VerifyEmail);
        /** notofier l'utilisateur pour le compte */
        return $user;
    }
}
