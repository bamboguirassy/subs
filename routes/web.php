<?php

use App\Http\Controllers\ProgrammeController;
use Illuminate\Support\Facades\Request;
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
    return view('home');
})->name('home');

Route::get('login', function() {
    return view('auth.login');
})->name('login');

Route::post('login', function(Request $request) {
    return view('auth.login');
})->name('login.request');

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
