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

Route::prefix('publik')->group(function () {
  Route::prefix('fakultas')->group(function () {
    Route::get('/', [
      App\Http\Controllers\Publik\DataPublikController::class,
      'getFakultas',
    ]);
  });
  Route::prefix('gelombang')->group(function () {
    Route::get('/', [
      App\Http\Controllers\Publik\DataPublikController::class,
      'getGelombang',
    ]);
  });
  Route::prefix('panduan')->group(function () {
    Route::get('/', [
      App\Http\Controllers\Publik\DataPublikController::class,
      'getPanduan',
    ]);
  });
});
