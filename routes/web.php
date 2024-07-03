<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('backend.components.dashboard');
});*/
Route::get('/',[AuthController::class,'registration'])->name('registration');
Route::post('/user_registration',[AuthController::class,'registrationPost'])->name('registration.post');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/user_login',[AuthController::class,'loginPost'])->name('login.post');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout']);
});
