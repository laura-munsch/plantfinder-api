<?php

use App\Http\Controllers\Api\CaracteristiqueController;
use App\Http\Controllers\Api\CategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlanteController;
use App\Models\Categorie;
use App\Models\Plante;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/plante', PlanteController::class);

Route::apiResource('/categorie', CategorieController::class);

Route::apiResource('/caracteristique', CaracteristiqueController::class);
