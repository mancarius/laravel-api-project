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


Route::get('/overview', function (Request $request) {

})->name('overview');


Route::get('/day/?{day}', function (Request $request) {
})->name('day');


Route::post('/day/{day}/{waste}', function (Request $request) {

});