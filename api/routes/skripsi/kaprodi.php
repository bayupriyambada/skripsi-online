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

Route::prefix('kaprodi')->group(function () {
  Route::prefix('login')->group(function () {
    Route::post('/', [
      App\Http\Controllers\Kaprodi\LoginController::class,
      'getLogin',
    ]);
  });
  Route::group(['middleware' => 'auth:api_kaprodi'], function () {

    Route::prefix('refreshToken')->group(function () {
      Route::post('/', [
        App\Http\Controllers\Kaprodi\LoginController::class,
        'getRefreshToken',
      ]);
    });
    Route::prefix('user')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Kaprodi\LoginController::class,
        'getUsers',
      ]);
    });
    Route::prefix('logout')->group(function () {
      Route::post('/', [
        App\Http\Controllers\Kaprodi\LoginController::class,
        'getLogout',
      ]);
    });
    /* A route fakultas group. */
    Route::prefix('fakultas')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Kaprodi\FakultasController::class,
        'getList',
      ]);
      Route::post('/save', [
        App\Http\Controllers\Kaprodi\FakultasController::class,
        'getSave',
      ]);
      Route::post('/{fakultasId}/delete', [
        App\Http\Controllers\Kaprodi\FakultasController::class,
        'getDelete',
      ]);
    });
    /* A route gelombang group. */
    Route::prefix('gelombang')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Kaprodi\GelombangController::class,
        'getList',
      ]);
      Route::post('/save', [
        App\Http\Controllers\Kaprodi\GelombangController::class,
        'getSave',
      ]);
      Route::post('/{fakultasId}/delete', [
        App\Http\Controllers\Kaprodi\GelombangController::class,
        'getDelete',
      ]);
    });

    /* A route verifikasi group. */
    Route::prefix('verifikasi')->group(function () {
      // mahasiswa verifikasi
      Route::prefix('pengajuan-skripsi')->group(function () {
        Route::get('/', [
          App\Http\Controllers\Kaprodi\PengajuanSkripsiController::class,
          'getList',
        ]);
        Route::post('/{pengajuanSkrispiId}/pengajuan', [
          App\Http\Controllers\Kaprodi\Verifikasi\VerifikasiPengajuanSkripsiController::class,
          'getVerifikasiPengajuan',
        ]);
      });
      
    });

  });
});
