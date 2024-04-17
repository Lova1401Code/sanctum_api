<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProjetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Routes du controlleur Etudiant
Route::post("register", [EtudiantController::class, 'register']);
Route::post("login", [EtudiantController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function(){
    //etudiant setting
    Route::get("profil", [EtudiantController::class, 'profil']);
    Route::get("logout", [EtudiantController::class, 'logout']);

    //projet manipulation
    Route::post("create", [ProjetController::class, 'create']);
    Route::get('detailProjet', [ProjetController::class, 'details']);
    Route::get('listeProjet', [ProjetController::class, 'liste']);
    Route::delete('delete', [ProjetController::class, 'delete']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
