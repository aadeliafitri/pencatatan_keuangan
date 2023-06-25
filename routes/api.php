<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('profil', [AuthController::class, 'getProfilUser']);

});

Route::group(['middleware' => 'jwt.auth'], function ($router) {

    Route::put('update-profile', [ProfileController::class, 'UpdateProfile']);

    Route::post('create-catatan', [KeuanganController::class, 'CreateCatatan']);
    Route::put('update-catatan/{id}', [KeuanganController::class, 'UpdateCatatan']);

    Route::get('user/keuangan', [UserController::class, 'DaftarKeuanganUser']);
});
