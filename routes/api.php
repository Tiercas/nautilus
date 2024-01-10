<?php

use App\Http\Controllers\DivesAPI;
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

Route::get('/dives/{id}/divers', [DivesAPI::class, 'getDivers']);

Route::middleware('App\Http\Middleware\rightChecker')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/palanques', [App\Http\Controllers\ManualPalanqueeController::class, 'store']);