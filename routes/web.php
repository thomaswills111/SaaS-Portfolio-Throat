<?php

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

Route::resource('ratings', RatingController::class)->only(['index', 'show', 'create']);
//Route::get('/ratings/create', [RatingController::class, 'add'])->name('ratings.create');
Route::middleware('auth')->group(function () {
    Route::resource('ratings', RatingController::class)->except(['index', 'show', 'create']);
    Route::get('/ratings/{rating}/delete', [RatingController::class, 'delete'])->name('ratings.delete');
    //Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
    //Route::patch('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update');
});


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
