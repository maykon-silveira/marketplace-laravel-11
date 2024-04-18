<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->controller(ProfileController::class)->group(function () {

    Route::get('/profile', 'edit')
    ->name('profile.edit');

    Route::patch('/profile', 'update')
    ->name('profile.update');

    Route::delete('/profile', 'destroy')
    ->name('profile.destroy');
});
