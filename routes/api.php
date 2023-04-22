<?php

use App\Http\Controllers\API\AdminController;
use App\Mail\UserContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MailController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SupportController;

// login user
Route::post('login', [AuthController::class, 'login']);
// register user
Route::post('register', [AuthController::class, 'register']);
// check is useraccount is present
Route::post('check_user_account', [AuthController::class, 'check_user_account']);
// reset user password after check
Route::post('set_new_password', [AuthController::class, 'set_new_password']);


Route::middleware('auth:api')->group(function (){

    // get user profile
    Route::get('profile', [UserController::class, 'index']);
    // contact us endpoint
    Route::post('contact_us', [MailController::class, 'contact_us']);
    // get partners
    Route::post('get_partners', [MailController::class, 'get_partners']);
    // get partners details
    Route::post('get_partner', [MailController::class, 'get_partner']);
    // get promoters
    Route::get('promoters', [MailController::class, 'promoters']);
    // get partners
    Route::get('partners', [MailController::class, 'partners']);

    // update user information
    Route::post('update_user_details', [UserController::class, 'update_user_details']);

});


Route::middleware('auth:admin')->group(function (){

    Route::post('promoters', [AdminController::class, 'promoters']);

    Route::get('promoter/${id}', [AdminController::class, 'promoter']);

    Route::post('partners', [AdminController::class, 'partners']);

    Route::get('partner/${id}', [AdminController::class, 'partner']);

});







// getapi/promoters
// api/promoters/$id
// api/partners
// api/contact_us
// api/update_user_details

