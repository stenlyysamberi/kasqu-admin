<?php

use App\Http\Controllers\ControllerMitra;
use App\Http\Controllers\ControllerUserman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/beranda',[ControllerMitra::class,'beranda']);

Route::post('/login',[ControllerUserman::class,'login_api']); //Login menggunakan phone dan password
Route::post('/fect_user',[ControllerUserman::class,'fect_user']); //akan menampilkan data user berdasarkan ID

