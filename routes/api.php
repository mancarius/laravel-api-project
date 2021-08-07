<?php

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


Route::resource('waste', App\Http\Controllers\WasteController::class)->only(['index', 'show']);

Route::resource('day', App\Http\Controllers\DayController::class)->only(['index', 'show']);

Route::resource('collection', App\Http\Controllers\WasteDayController::class)->except(['index', 'show', 'create', 'edit']);