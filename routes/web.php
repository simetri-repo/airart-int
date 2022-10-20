<?php

use App\Http\Controllers\ControllerHistory;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerReminder;
use App\Http\Controllers\ControllerRKategori;
use App\Http\Controllers\ControllerSatwa;
use App\Http\Controllers\ControllerSupport;
use App\Http\Controllers\ControllerUser;
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



Route::get('/', function () {
    return view('index');
});
Route::post('Login', [ControllerLogin::class, 'login']);
Route::get('Logout', [ControllerLogin::class, 'Logout']);

// admin
Route::get('admHome', function () {
    return view('adm.home');
});
Route::get('admHome', [ControllerSupport::class, 'admHome']);
Route::get('admDatsat', [ControllerSatwa::class, 'show_satwa']);
Route::get('admDatusr', [ControllerUser::class, 'show_user']);
Route::get('admDatpic', [ControllerUser::class, 'show_pic']);
Route::get('admDathistory', [ControllerHistory::class, 'show_history']);
Route::get('admRemin', [ControllerReminder::class, 'show_reminder']);
Route::get('r_lokasi', [ControllerRKategori::class, 'show_r_lokasi']);
Route::get('r_keterangan', [ControllerRKategori::class, 'show_r_keterangan']);
Route::get('r_status', [ControllerRKategori::class, 'show_r_status']);
Route::get('r_ras', [ControllerRKategori::class, 'show_r_ras']);
Route::get('r_anakan', [ControllerRKategori::class, 'show_r_anakan']);
Route::get('admCarisat', [ControllerSatwa::class, 'cari_satwa']);
// pic
Route::get('picSatwaSaya', [ControllerSatwa::class, 'show_satwa_saya']);
Route::get('dataSaya', [ControllerUser::class, 'dataSaya']);
Route::post('ganti_password', [ControllerUser::class, 'ganti_password']);


// Route::post('admCarisat', [ControllerSatwa::class, 'cari_satwa']);
Route::get('admProfsat/{id_satwa}', [ControllerSatwa::class, 'profile_satwa_id']);

Route::post('admCarisatwa', [ControllerSatwa::class, 'cari_satwa']);


Route::post('new_pic', [ControllerUser::class, 'new_pic']);
Route::post('update_pic/{id_pic}', [ControllerUser::class, 'update_pic']);

Route::post('new_user', [ControllerUser::class, 'new_user']);
Route::post('update_user/{id_pic}', [ControllerUser::class, 'update_user']);
Route::get('reset_pass/{id}', [ControllerUser::class, 'reset_pass']);

// satwa
Route::post('new_satwa', [ControllerSatwa::class, 'new_satwa']);
Route::post('update_satwa/{id_satwa}', [ControllerSatwa::class, 'update_satwa']);
Route::get('hapus_satwa/{id_satwa}', [ControllerSatwa::class, 'hapus_satwa']);


Route::post('new_history', [ControllerHistory::class, 'new_history']);
Route::get('show_history_id/{id_satwa}/{nama_satwa}', [ControllerHistory::class, 'show_history_id']);

Route::post('new_reminder', [ControllerReminder::class, 'new_reminder']);
Route::post('update_reminder/{id_reminder}', [ControllerReminder::class, 'update_reminder']);
Route::get('hapus_reminder/{id_reminder}', [ControllerReminder::class, 'hapus_reminder']);

// support

Route::post('new_ras', [ControllerSupport::class, 'new_ras']);
Route::get('hapus_ras/{id}', [ControllerSupport::class, 'hapus_ras']);

Route::post('new_lokasi', [ControllerSupport::class, 'new_lokasi']);
Route::get('hapus_lokasi/{id}', [ControllerSupport::class, 'hapus_lokasi']);

Route::post('new_status', [ControllerSupport::class, 'new_status']);
Route::get('hapus_status/{id}', [ControllerSupport::class, 'hapus_status']);

Route::post('new_keterangan', [ControllerSupport::class, 'new_keterangan']);
Route::get('hapus_keterangan/{id}', [ControllerSupport::class, 'hapus_keterangan']);

Route::post('new_anakan', [ControllerSupport::class, 'new_anakan']);
Route::post('update_anakan/{id}', [ControllerSupport::class, 'update_anakan']);
Route::get('hapus_anakan/{id}', [ControllerSupport::class, 'hapus_anakan']);






// PIC
Route::get('picHome', [ControllerSupport::class, 'admHome']);

Route::get('show_satwa_id/{id}', [ControllerSatwa::class, 'show_satwa_id']);
