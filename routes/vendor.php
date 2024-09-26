<?php

use App\Http\Controllers\Backend\Vendor\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use Illuminate\Support\Facades\Route;

/** Vendor Routes*/
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile',   [ProfileController::class, 'index'])->name('profile');
Route::put('profile',   [ProfileController::class,'update'])->name('profile.update');//vendor.profile.update
Route::post('profile',   [ProfileController::class,'updatePassword'])->name('profile.update.password');
