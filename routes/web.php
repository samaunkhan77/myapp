<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.components.dashboard');
});
Route::get('/registration',[AuthController::class,'registration'])->name('registration');
Route::post('/registration',[AuthController::class,'registrationPost'])->name('registration.post');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginPost'])->name('login.post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
