<?php

use App\Http\Controllers\API\DefinitionController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\wordTypeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')
    ->post('/logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')
    ->post('/wordTypes', [UserController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('wordTypes', WordTypeController::class);
    Route::apiResource('words', WordController::class)->except('index', 'show');
    Route::apiResource('definitions', DefinitionController::class)->except('index', 'show');
    Route::post('/definitions/{definition}/rate', [DefinitionController::class, 'addRating']);
    Route::put('/definitions/{definition}/rate/{rating}', [DefinitionController::class, 'updateRating']);
    Route::delete('/definitions/{definition}/rate/{rating}', [DefinitionController::class, 'removeRating']);
});

Route::apiResource('words', WordController::class)->except('create', 'edit', 'delete');
Route::apiResource('definitions', DefinitionController::class)->except('create', 'edit', 'delete');



