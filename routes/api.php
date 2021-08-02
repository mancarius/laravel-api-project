<?php

use App\Http\Controllers\DayController;
use App\Http\Controllers\WasteController;
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


Route::get('/day/{id?}', [DayController::class, 'show'])->name('day');


Route::get('/waste/{id?}', [WasteController::class, 'show'])->name('waste');


Route::post('/day/{day}/{waste}', function (Request $request) {

});