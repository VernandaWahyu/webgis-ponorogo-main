<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MapUserController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MapUserController::class, 'index']);
// Route::get('/maps', MapController::class);
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changepassword'])->name('profile.change-password');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/blank-page', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');
    Route::get('/maps', [MapController::class, 'index'])->name('maps');
    Route::get('/maps/create', [MapController::class, 'create'])->name('maps.create');
    Route::post('/maps', [MapController::class, 'store'])->name('maps.store');
    Route::get('/maps/{map}/edit', [MapController::class, 'edit'])->name('maps.edit');
    Route::put('/maps/{map}', [MapController::class, 'update'])->name('maps.update');
    Route::delete('/maps/{map}', [MapController::class, 'destroy'])->name('maps.destroy');
    

    Route::get('/hakakses', [App\Http\Controllers\HakaksesController::class, 'index'])->name('hakakses.index')->middleware('superadmin');
    Route::get('/hakakses/edit/{id}', [App\Http\Controllers\HakaksesController::class, 'edit'])->name('hakakses.edit')->middleware('superadmin');
    Route::put('/hakakses/update/{id}', [App\Http\Controllers\HakaksesController::class, 'update'])->name('hakakses.update')->middleware('superadmin');
    Route::delete('/hakakses/delete/{id}', [App\Http\Controllers\HakaksesController::class, 'destroy'])->name('hakakses.delete')->middleware('superadmin');

});