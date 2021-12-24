<?php

use App\Custom\Event;
use App\Http\Controllers\AchatSmsController;
use App\Http\Controllers\AppelFondController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SouscriptionController;
use App\Models\Parametrage;
use App\Models\Programme;
use App\Models\Souscription;
use App\Models\TypeProgramme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PragmaRX\Countries\Package\Countries;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::get('', function () {
    $programmeActives = Programme::where('dateCloture', '>=', date_format(new DateTime(), 'Y-m-d'))
        ->orderBy('dateCloture')->whereProgrammeId(null)->paginate(20);
    $programmeActives = $programmeActives->filter(function ($programme) {
        return $programme->is_public;
    });
    $formationModulaires = Programme::whereProgrammeId(null)->whereHas('sessionActives')->get();
    $programmeActives = $programmeActives->merge($formationModulaires);
    $qrcode = null;
    if(Auth::check()) {
        $qrcode = QrCode::size(200)->generate(Auth::user()->email);
    }
    return view('home',compact('programmeActives','qrcode'));
})->name('home');

Route::get('public', function () {
    $programmeActives = Programme::where('dateCloture', '>=', date_format(new DateTime(), 'Y-m-d'))
        ->orderBy('dateCloture')->paginate(20);
    $programmeActives = $programmeActives->filter(function ($programme) {
        return $programme->is_public;
    });
    return view('programme.public', compact('programmeActives'));
})->name('programme.public.list');

Route::get('login', function (Request $request) {
    $ret = $request->get('ret');
    $request->session()->put('ret', $ret);
    return view('auth.login');
})->name('login');

Route::get('profile', function (User $user = null) {
    return view('auth.profile', compact('user'));
})->middleware('auth')->name('profile');

Route::get('notification', function () {
    return view('auth.notifications');
})->middleware('auth')->name('user.notification.list');

Route::post('login', function (Request $request) {
    $request->validate([
        'email' => 'required|exists:users,email|email',
        'password' => 'required|min:6'
    ]);
    if (Auth::attempt($request->only('email', 'password'))) {
        notify()->success("Vous êtes connecté avec succès");
        if (session()->exists('ret')) {
            $retUrl = session('ret');
            session()->remove('ret');
            return redirect()->to($retUrl);
        }
        return redirect()->route('home');
    } else {
        notify()->error("Vérifiez vos identifiants de connexion et réssayer !");
        return back()->withErrors(['error' => "Vérifiez vos identifiants de connexion puis réssayer !"]);
    }
    return;
})->name('login.request');

Route::get('programme/pre-publish', function () {
    $typeProgrammes = TypeProgramme::orderBy('nom')->whereEnabled(true)->get();
    return view('programme.pre-publish', compact('typeProgrammes'));
})->name('programme.pre.publish');

Route::put('programme/{programme}/suspendre',[ProgrammeController::class,'suspendre'])
->name('programme.suspendre')->middleware('auth');

Route::resource('programme', ProgrammeController::class, [
    'only' => ['create', 'store', 'show']
])->middleware('web');

Route::resource('programme', ProgrammeController::class, [
    'only' => ['destroy', 'edit', 'update']
])->middleware('auth');

Route::get('souscription/{programme}/create', function (Request $request, Programme $programme) {
    if($programme->is_formation_modulaire) {
        if($request->exists('step')) {
            if($request->step=='session') {
                return view('programme.formation.choose-session',compact('programme'));
            } else if($request->step=='module') {
                return view('programme.formation.choose-modules',compact('programme'));
            } else {
                notify()->error("Programme non précisé");
                return back();
            }
        }
    }
    // vérifier si user n'a pas déja souscrit
    if ($programme->current_user_souscription) {
        notify()->warning("Vous avez déja souscrit à ce programme !");
        return redirect()->route('programme.show', compact('programme'));
    } else if (!$programme->active) {
        notify()->warning("Ce programme est déja cloturé, vous ne pourrez malheureusement plus postuler...");
        return back();
    }

    $countrieSrv = new Countries();
    $senegal = $countrieSrv->where('cca2', 'SN')->first();
    return view('programme.souscription.new', compact('programme', 'senegal'));
})->name('souscription.new');

Route::post('souscription_pin', 'App\Http\Controllers\SouscriptionController@instantPaymentNotificate')
    ->name('souscription.pin');

Route::post('souscription/{programme}/email', [SouscriptionController::class, 'sendMail'])
    ->middleware('auth')->name('send.email.to.participants');

Route::post('souscription/{programme}/sms', [SouscriptionController::class, 'sendSMS'])
    ->middleware('auth')->name('send.sms.to.participants');

Route::resource('souscription', SouscriptionController::class, [
    'only' => ['store', 'update','destroy']
]);

Route::resource('user', UserController::class, [
    'only' => ['update']
]);
// changement mdp
Route::put('change-password', function (Request $request, User $user = null) {
    $request->validate([
        'currentPassword' => 'required|min:6',
        'password' => 'confirmed'
    ]);
    $user = User::find(Auth::user()->id);
    if (Hash::check($request->get('currentPassword'), $user->password)) {
        $user->password = Hash::make($request->get('password'));
        $user->update();
        notify()->success("Votre mot de passe a été changé avec succès !");
        Auth::logout();
    } else {
        notify()->error("Le mot de passe saisi est incorrect !");
    }
    return back();
})->name('change.password.request')->middleware('auth');

Route::get('paymentconfirmation', function (Request $request) {
    $souscription = Souscription::find($request->get('id'));
    return view('programme.souscription.payment-confirmation', ['state' => $request->get('state'), 'souscription' => $souscription]);
});

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::get('apropos', function () {
    $parametrage = Parametrage::getInstance();
    return view('apropos', compact('parametrage'));
})->name('apropos');

Route::get('countries', function () {
    $countrieSrv = new Countries();
    $data = $countrieSrv->all();
    $countries = [];
    foreach ($data as $country) {
        $countries[] = $country;
    }
    return $countries;
});

Route::resource('appelfond', AppelFondController::class, [
    'only' => ['store']
])->middleware('auth');

Route::get('trigger-event', function () {
    if (Auth::check()) {
        Event::dispatchUserEvent(Event::Message('User Event', "Salut User - " . Auth::user()->name), Auth::user());
    } else {
        Event::dispatchGeneralEvent(Event::Message('Public Message', 'Message complet de user !'));
    }
});

Route::post('achat_sms_pin', 'App\Http\Controllers\AchatSmsController@instantPaymentNotificate')
    ->name('achatsms.pin');

Route::resource('achatsms', AchatSmsController::class, [
    'only' => ['create', 'store']
])->middleware("auth");

include_once "admin.php";
