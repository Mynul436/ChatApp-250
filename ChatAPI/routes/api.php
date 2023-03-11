<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//public routes
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'Login']);
Route::post('/sendpasswordresetemail',[PasswordResetController::class,'send_password_reset_email']);


//protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[UserController::class,'Logout']);
    Route::get('/loggeduser',[UserController::class,'logged_user']);
    Route::post('changepassword',[UserController::class,'change_password']);
    Route ::get('/usersprofile',[UserController::class,'usersprofile']);
    Route::post('/updateprofile',[UserController::class,'update_profile']);
    Route::get('/users',[UserController::class,'getUsers']);
   // Route::post('/update',[UserController::class,'updateUser']);
   // Route::post('/delete',[UserController::class,'deleteUser']);
});

Route::get('/test',[Controller::class,'test']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
