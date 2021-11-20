<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SouscriptionController;
use App\Models\Programme;
use App\Models\Souscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    $programmeActives = Programme::where('dateCloture', '>', new DateTime())
        ->orderBy('dateCloture')->paginate(20);
    return view('home', compact('programmeActives'));
})->name('home');

Route::get('login', function (Request $request) {
    $ret = $request->get('ret');
    $request->session()->put('ret', $ret);
    return view('auth.login');
})->name('login');

Route::get('profile', function(User $user=null) {
    return view('auth.profile',compact('user'));
    })->middleware('auth')->name('profile');

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

Route::put('users/{id}', function ($id) {

});

Route::resource('programme', ProgrammeController::class, [
    'only' => ['create', 'store', 'show']
])->middleware('web');

Route::resource('programme', ProgrammeController::class, [
    'only' => ['destroy', 'edit', 'update', 'index']
])->middleware('auth');

Route::get('mesprogrammes', function () {
    $title = "mes programmes";
    $programmes = Auth::user()->programmes;
    return view('programme.list', compact('programmes', 'title'));
})->middleware('verified')->name('mes.programmes');

Route::get('messouscriptions', function () {
    $title = "mes souscriptions";
    $programmes = Auth::user()->programmeSouscrits;
    return view('programme.list', compact('programmes', 'title'));
})->middleware('verified')->name('mes.souscriptions');

Route::get('souscription/{programme}/create', function (Programme $programme) {
    // vérifier si user n'a pas déja souscrit
    if ($programme->current_user_souscription) {
        notify()->warning("Vous avez déja souscrit à ce programme !");
        return redirect()->route('programme.show', compact('programme'));
    } else if(!$programme->active) {
        notify()->warning("Ce programme est déja cloturé, vous ne pourrez malheureusement plus postuler...");
        return back();
    }
    return view('programme.souscription.new', compact('programme'));
})->name('souscription.new');

Route::post('souscription_pin', 'App\Http\Controllers\SouscriptionController@instantPaymentNotificate')
    ->name('souscription.pin');

Route::post('souscription/{programme}/contact', [SouscriptionController::class, 'sendMail'])
->middleware('auth')->name('send.email.to.participants');

Route::resource('souscription', SouscriptionController::class, [
    'only' => ['store','update']
]);

Route::resource('user', UserController::class, [
    'only' => ['update']
]);
// changement mdp
Route::put('change-password',function(Request $request, User $user=null) {
    $request->validate([
        'currentPassword'=>'required|min:6',
        'password'=>'confirmed'
    ]);
    $user = User::find(Auth::user()->id);
    if(Hash::check($request->get('currentPassword'), $user->password)) {
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
