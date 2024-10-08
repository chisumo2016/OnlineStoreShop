<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\ProfileController;

use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');



Route::group(['middleware' => ['auth', 'verified'], 'prefix' =>'user'  , 'as' => 'user.'], function (){
    Route::get('dashboard', [UserController::class,'index'])->name('dashboard');
    Route::get('profile',   [ProfileController::class,'index'])->name('profile');
    Route::put('profile',   [ProfileController::class,'update'])->name('profile.update');
    Route::post('profile',   [ProfileController::class,'updatePassword'])->name('profile.update.password');

});



