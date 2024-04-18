<?php

use App\Http\Controllers\Backend\VendorController;
use Illuminate\Support\Facades\Route;

//rota vendedor
Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])
->middleware(['auth', 'vendor'])
->name('vendor.dashboard');

