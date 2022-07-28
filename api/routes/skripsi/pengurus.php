<?php

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

Route::prefix('pengurus')->group(function () {
  Route::prefix('login')->group(function () {
    Route::post('/', [
      App\Http\Controllers\Pengurus\LoginController::class,
      'getLogin',
    ]);
  });
  Route::group(['middleware' => 'auth:api_pengurus'], function () {

    Route::prefix('refresh')->group(function () {
      Route::post('/', [
        App\Http\Controllers\Pengurus\LoginController::class,
        'getRefreshToken',
      ]);
    });
    Route::prefix('user')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Pengurus\LoginController::class,
        'getUsers',
      ]);
    });
    Route::prefix('logout')->group(function () {
      Route::post('/', [
        App\Http\Controllers\Pengurus\LoginController::class,
        'getLogout',
      ]);
    });
    /* A route panduan-skripsi group. */
    Route::prefix('panduan')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Pengurus\PanduanSkripsiController::class,
        'getList',
      ]);
      Route::post('/save', [
        App\Http\Controllers\Pengurus\PanduanSkripsiController::class,
        'getSave',
      ]);
      Route::delete('/{panduanSkripsiId}/delete', [
        App\Http\Controllers\Pengurus\PanduanSkripsiController::class,
        'getDelete',
      ]);
    });
    /* A route mahasiswa dosen group. */
    Route::prefix('dosen-mahasiswa')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Pengurus\DospemMahasiswaController::class,
        'getList',
      ]);
      Route::post('/save', [
        App\Http\Controllers\Pengurus\DospemMahasiswaController::class,
        'getSave',
      ]);
      Route::delete('/{dosenMahasiswaId}/delete', [
        App\Http\Controllers\Pengurus\DospemMahasiswaController::class,
        'getDelete',
      ]);
    });
    /* A route pengajuanSkripsiAcc group. */
    Route::prefix('datalist')->group(function () {
      Route::get('/dospem', [
        App\Http\Controllers\Pengurus\DataListMahasiswaDospemController::class,
        'getDospem',
      ]);
      Route::get('/mahasiswa', [
        App\Http\Controllers\Pengurus\DataListMahasiswaDospemController::class,
        'getMahasiswa',
      ]);
    });
    /* A route pengajuanSkripsiAcc group. */
    Route::prefix('pengajuan-skripsi')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Pengurus\DaftarPengajuanSkripsiController::class,
        'getDaftarPengajuanSkripsiAcc',
      ]);
    });
    Route::prefix('data-dospem')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Pengurus\DospemListController::class,
        'getList',
      ]);
    });
  });
});
