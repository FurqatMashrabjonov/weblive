<?php

use App\Http\Controllers\Git\AuthController;
use App\Http\Controllers\Git\ConnectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('auth')
    ->controller(AuthController::class)
    ->as('git.auth.')
    ->group(function (){
    Route::get('/{driver}/redirect', 'redirect')->name('redirect');
    Route::get('/{driver}/callback', 'callback')->name('callback');
});

Route::prefix('connect')
    ->controller(ConnectController::class)
    ->as('git.connect.')
    ->group(function (){

    Route::get('/{driver}/redirect', 'redirect')->name('redirect');
    Route::get('/{driver}/callback', 'callback')->name('callback');

});
