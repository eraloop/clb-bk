<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


// login user
Route::post('login', [AuthController::class, 'login']);
// register user
Route::post('register', [AuthController::class, 'register']);
// contact us
Route::post('contact', [SupportController::class, 'contact']);

Route::middleware('auth:api')->group(function (){
// get user profile
Route::get('profile', [AuthController::class, 'index']);

});
