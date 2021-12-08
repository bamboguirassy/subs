<?php

use App\Http\Controllers\AppelFondController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('appelfond', AppelFondController::class, [
        'only' => ['index','update']
    ]);
    Route::resource('user', UserController::class, [
        'only' => ['index']
    ]);
    Route::resource('programme', ProgrammeController::class, [
        'only' => ['index']
    ]);
});
