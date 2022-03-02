<?php

use App\Http\Controllers\ControllerMitra;
use App\Http\Controllers\ControllerPemasukan;
use App\Http\Controllers\ControllerUserman;
use App\KasPemasukan;
use App\ModelMitra;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login',[
        "menu1" => "Beranda",
        "menu2" => "Beranda",
        "title" => "Admin Kasqu | login"
    ]);
})->name('login')->middleware('guest');

//Route::post('/ac_login',[ControllerUserman::class,'login']);
Route::post('/login',[ControllerUserman::class,'login'])->middleware('guest');

Route::get('/', function () {
    return view('Beranda',[
        "menu1" => "Beranda",
        "menu2" => "Beranda",
        "title" => "Beranda"
    ]);
}); 
// ->middleware('auth')

Route::get('/beranda', function () {
    return view('beranda',[
        "menu1" => "Beranda",
        "menu2" => "Beranda",
        "title" => "Beranda"
    ]);
});






Route::get('/masuk',[ControllerPemasukan::class,'index'])->middleware('auth');
Route::post('/tamba_kas',[ControllerPemasukan::class,'store'])->middleware('auth');
Route::post('/del_pemasukan',[ControllerPemasukan::class,'hapus'])->middleware('auth');
Route::post('/edit_kasmasuk',[ControllerPemasukan::class,'edit'])->middleware('auth');


Route::get('/keluar',[App\Http\Controllers\ControllerPengeluaran::class,'index'])->middleware('auth');
Route::post('/tamba_kaskeluar',[App\Http\Controllers\ControllerPengeluaran::class,'tambakas'])->middleware('auth');
Route::post('/edit_kaskeluar',[App\Http\Controllers\ControllerPengeluaran::class,'edit'])->middleware('auth');
Route::post('/del_pengeluaran',[App\Http\Controllers\ControllerPengeluaran::class,'hapus'])->middleware('auth');



Route::get('/sumber_pemasukan', [ControllerMitra::class,'index'])->middleware('auth');
Route::post('/create_mitra', [ControllerMitra::class,'save'])->middleware('auth');
Route::post('/del_mitra',[ControllerMitra::class,'hapus'])->middleware('auth');
Route::post('/edit_mitra',[ControllerMitra::class,'edit'])->middleware('auth');


Route::get('/report_masuk',[App\Http\Controllers\ControllerPemasukan::class,'report_masuk'])->middleware('auth');
Route::get('/report_keluar',[App\Http\Controllers\ControllerPengeluaran::class,'report_keluar'])->middleware('auth');


Route::post('/add_userman',[ControllerUserman::class,'store']);
// ->middleware('auth')
Route::post('/del_userman',[ControllerUserman::class,'hapus'])->middleware('auth');
// ->middleware('auth')
Route::post('/edit_userman',[ControllerUserman::class,'edit'])->middleware('auth');

Route::get('/user',[ControllerUserman::class,'index']);
// ->middleware('auth')
Route::post('/logout',[ControllerUserman::class,'keluar'])->middleware('auth');
// ->middleware('auth')


// Route::post('/add_userman',[ControllerUserman::class,'store']);
// Route::post('/login-userman',[ControllerUserman::class,'login']);
// Route::post('/coba',[ControllerUserman::class,'login']);

