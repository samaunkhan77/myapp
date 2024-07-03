<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.components.dashboard');
});
Route::get('/registration',[AuthController::class,'registration'])->name('registration');
Route::post('/user_registration',[AuthController::class,'registrationPost'])->name('registration.post');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginPost'])->name('login.post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
});
