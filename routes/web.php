<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StaticPageController;
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

//Route::middleware('auth')->group(function () {
//    Route::resource('ratings', RatingController::class)->except(['index', 'show']);
//    Route::get('/ratings/{rating}/delete', [RatingController::class, 'delete'])->name('ratings.delete');

//Route::get('/ratings', [RatingController::class, 'index'])->middleware('auth')->name('ratings.index');


Route::group(['middleware' => ['role:admin|staff|user']], function () {
    Route::resource('words', WordController::class)
        ->except(['index', 'show']);

    Route::resource('definitions', DefinitionController::class)
        ->except(['index', 'show']);


    Route::get('/definitions/{definition}/delete', [DefinitionController::class, 'delete'])
        ->name('definitions.delete');
    Route::get('/words/{word}/delete', [WordController::class, 'delete'])
        ->name('words.delete');

    Route::get('/definitions/{definition}/rate', [DefinitionController::class, 'rate'])
        ->name('definitions.rate');
    Route::post('/definitions/{definition}/rate/{rating}', [DefinitionController::class, 'storeDefinitionRating'])
        ->name('definitionRating.store');
    Route::get('/definitions/create/{word}', [DefinitionController::class, 'create'])
        ->name('definitionsWord.create');
    Route::post('/definitions/rate/{definition}', [DefinitionController::class, 'storeNewDefinitionRating'])
        ->name('newDefinitionRating.store');

    Route::delete('/definitions/{definition}/rate', [DefinitionController::class, 'removeDefinitionRating'])
        ->name('definitionRating.remove');
});


Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('ratings', RatingController::class);
    Route::resource('wordTypes', WordTypeController::class);
    Route::get('/ratings/{rating}/delete', [RatingController::class, 'delete'])
        ->name('ratings.delete');
    Route::get('/wordTypes/{wordType}/delete', [WordTypeController::class, 'delete'])
        ->name('wordTypes.delete');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    Route::patch('/admin/dashboard/{user}', [AdminController::class, 'updateRole'])
        ->name('admin.updateRole');
});


Route::resource('words', WordController::class)
    ->except(['destroy', 'edit', 'create']);
Route::resource('definitions', DefinitionController::class)
    ->except(['destroy', 'edit', 'create']);

Route::get('/', [StaticPageController::class, 'home'])
    ->name('static.home');
Route::get('/privacy', [StaticPageController::class, 'privacy'])
    ->name('static.privacy');
Route::get('/contact', [StaticPageController::class, 'contact'])
    ->name('static.contact');
Route::get('/termsAndConditions', [StaticPageController::class, 'terms'])
    ->name('static.terms');
Route::get('/colours', [StaticPageController::class, 'colours'])
    ->name('static.colours');
Route::get('/icons', [StaticPageController::class, 'icons'])
    ->name('static.icons');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';

