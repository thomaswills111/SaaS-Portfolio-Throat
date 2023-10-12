<?php

use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\WordTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('ratings', RatingController::class);
Route::get('/ratings/{rating}/delete', [RatingController::class, 'delete'])->name('ratings.delete');
// Route::get('/ratings/create/{definition}', [RatingController::class, 'create'])->name('ratingsDefinition.create');
// Route::post('/ratings/create/{definition}', [RatingController::class, 'store'])->name('newRatingsDefinition.store');
// Route::post('/ratings/{definition}', [RatingController::class, 'rateDefinition'])->name('ratingsDefinition.store');

Route::resource('wordTypes', WordTypeController::class);
Route::get('/wordTypes/{wordType}/delete', [WordTypeController::class, 'delete'])->name('wordTypes.delete');

Route::resource('definitions', DefinitionController::class);
Route::get('/definitions/{definition}/delete', [DefinitionController::class, 'delete'])->name('definitions.delete');
Route::get('/definitions/{definition}/rate', [DefinitionController::class, 'rate'])->name('definitions.rate');
Route::post('/definitions/{definition}/rate', [DefinitionController::class, 'storeDefinitionRating'])->name('definitionRating.store');
Route::get('/definitions/create/{word}', [DefinitionController::class, 'create'])->name('definitionsWord.create');
Route::post('/definitions/rate/{definition}', [DefinitionController::class, 'storeNewDefinitionRating'])->name('newDefinitionRating.store');

Route::resource('words', WordController::class);
Route::get('/words/{word}/delete', [WordController::class, 'delete'])->name('words.delete');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
