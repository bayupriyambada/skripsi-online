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

Route::prefix('mahasiswa')->group(function () {
  Route::prefix('login')->group(function () {
    Route::post('/', [
      App\Http\Controllers\Mahasiswa\LoginController::class,
      'getLogin',
    ]);
  });
  Route::prefix('register')->group(function () {
    Route::post('/', [
      App\Http\Controllers\Mahasiswa\LoginController::class,
      'getRegister',
    ]);
  });
  Route::group(['middleware' => 'auth:api_mahasiswa'], function () {

    Route::prefix('refresh')->group(function () {
      Route::post('/', [
        App\Http\Controllers\Mahasiswa\LoginController::class,
        'getRefreshToken',
      ]);
    });
    Route::prefix('user')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Mahasiswa\LoginController::class,
        'getUsers',
      ]);
    });
    Route::prefix('logout')->group(function () {
      Route::post('/', [
        App\Http\Controllers\Mahasiswa\LoginController::class,
        'getLogout',
      ]);
    });
    /* A route pengajuan-skripsi group. */
    Route::prefix('pengajuan-skripsi')->group(function () {
      Route::get('/', [
        App\Http\Controllers\Mahasiswa\PengajuanSkripsiController::class,
        'getList',
      ]);
      Route::post('/save', [
        App\Http\Controllers\Mahasiswa\PengajuanSkripsiController::class,
        'getSave',
      ]);
      Route::post('/{pengajuanSkripsiId}/delete', [
        App\Http\Controllers\Mahasiswa\PengajuanSkripsiController::class,
        'getDelete',
      ]);
    });
    /* A route pengajuan-skripsi group. */
    Route::prefix('notifikasi')->group(function () {
      Route::get('/pengajuan', [
        App\Http\Controllers\Mahasiswa\Notification\GetNotificationController::class,
        'getNotificationPengajuan',
      ]);
    });

  });
});
