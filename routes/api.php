<?php

use App\Http\Controllers\ControllerMitra;
use App\Http\Controllers\ControllerPemasukan;
use App\Http\Controllers\ControllerUserman;
use App\KasPemasukan;
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

Route::post('/get_user_mitra',[ControllerMitra::class,'get_mitra_user']);//menampilkan data di beranda

Route::post('/beranda',[ControllerMitra::class,'beranda']);//menampilkan data di beranda

Route::post('/login',[ControllerUserman::class,'login_api']); //Login menggunakan phone dan password
Route::post('/fect_user',[ControllerUserman::class,'fect_user']); //akan menampilkan data user berdasarkan ID
Route::post('/edit_user',[ControllerUserman::class,'edit_user']); //akan menampilkan data user berdasarkan ID

Route::post('/bayar',[ControllerPemasukan::class,'bayar']); //Bayar Uang Tagihan

Route::get('/income',[ControllerPemasukan::class,'income']);



#API FOR JONAS iOT
// $router->get('status','WaterController@index');
// $router->delete('status/{id}',['uses' => 'WaterController@destroy']);
// $router->put('status/{id}',['uses' => 'WaterController@update']);
// $router->post('status','WaterController@create');