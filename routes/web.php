<?php

use App\Http\Controllers\DivesList;
use App\Http\Controllers\DivingNumberController;
use App\Models\DivingNumberModel;
use App\Models\DivingSession;
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
Route::get('/login', function () {
    return view('login');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dives', [DivesList::class, 'index']);

Route::get('/divings', [DivingNumberController::class, 'index']);

Route::get('/alldivings', [DivingNumberController::class, 'allIndex']);


