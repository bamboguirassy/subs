<?php

use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SouscriptionController;
use App\Models\Programme;
use App\Models\Souscription;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    $programmeActives = Programme::where('dateCloture','>=',new DateTime())
    ->orderBy('dateCloture')->paginate(20);
    return view('home',compact('programmeActives'));
})->name('home');

Route::get('login', function(Request $request) {
    $ret = $request->get('ret');
    $request->session()->put('ret', $ret);
    return view('auth.login');
})->name('login');

Route::post('login', function(Request $request) {
    $request->validate([
        'email'=>'required|exists:users,email|email',
        'password'=>'required|min:6'
    ]);
    if(Auth::attempt($request->only('email','password'))) {
        notify()->success("Vous êtes connecté avec succès");
        if(session()->exists('ret')) {
            $retUrl = session('ret');
            session()->remove('ret');
            return redirect()->to($retUrl);
        }
        return redirect()->route('home');
    } else {
        notify()->error("Vérifiez vos identifiants de connexion et réssayer !");
        return back()->withErrors(['error'=>"Vérifiez vos identifiants de connexion puis réssayer !"]);
    }
    return ;
})->name('login.request');

Route::get('logout',function() {
    Auth::logout();
    notify()->success("Vous êtes déconnecté avec succès !");
    return redirect()->route('home');
})->name('logout')->middleware('auth');

Route::resource('programme', ProgrammeController::class,[
    'only'=>['create','store','show']
])->middleware('web');

Route::resource('programme', ProgrammeController::class,[
    'only'=>['destroy','edit','update','index']
])->middleware('auth');

Route::get('mesprogrammes',function() {
 return view('programme.list');
})->middleware('auth')->name('mes.programmes');

Route::get('messouscriptions',function() {
 return view('programme.list');
})->middleware('auth')->name('mes.souscriptions');

Route::get('souscription/{programme}/create',function(Programme $programme) {
    // vérifier si user n'a pas déja souscrit
    if($programme->current_user_souscription) {
        notify()->warning("Vous avez déja souscrit à ce programme !");
        return redirect()->route('programme.show',compact('programme'));
    }
    return view('programme.souscription.new',compact('programme'));
})->name('souscription.new');

Route::post('souscription_pin','App\Http\Controllers\SouscriptionController@instantPaymentNotificate')
->name('souscription.pin');

Route::resource('souscription', SouscriptionController::class,[
    'only'=>['store']
]);

Route::get('paymentconfirmation', function (Request $request) {
    $souscription = Souscription::find($request->get('id'));
    return view('programme.souscription.payment-confirmation',['state'=>$request->get('state'),'souscription'=>$souscription]);
});
