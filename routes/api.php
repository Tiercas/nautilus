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

Route::middleware('App\Http\Middleware\RightChecker')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/palanques', [App\Http\Controllers\ManualPalanqueeController::class, 'store']);

Route::get('/boat', [App\Http\Controllers\DataController\DataBoatController::class, 'fetch']);

Route::get('/divinggroup',  [App\Http\Controllers\DataController\DataDivingGroupController::class, 'fetch']);

Route::get('/divinglocation',  [App\Http\Controllers\DataController\DataDivingLocationController::class, 'fetch']);

Route::get('/divingsession',  [App\Http\Controllers\DataController\DataDivingSessionController::class, 'fetch']);

Route::get('/divingsession',  [App\Http\Controllers\DataController\DataDivingSessionController::class, 'fetch']);

Route::get('/prerogative',  [App\Http\Controllers\DataController\DataPrerogativeController::class, 'fetch']);

Route::get('/registration',  [App\Http\Controllers\DataController\DataRegistrationController::class, 'fetch']);

Route::get('/role',  [App\Http\Controllers\DataController\DataRoleController::class, 'fetch']);

Route::get('/roleattribution',  [App\Http\Controllers\DataController\DataRoleAttributionController::class, 'fetch']);

Route::get('/user',  [App\Http\Controllers\DataController\DataUserController::class, 'fetch']);

Route::post('/subscribe', [App\Http\Controllers\ApiController\SubscribeApi::class, 'subscribe']);

Route::get('/dives', [App\Http\Controllers\ApiController\DivesApi::class, 'fetch']);

Route::post('/createdive', [App\Http\Controllers\ApiController\CreateDive::class, 'create']);