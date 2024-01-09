<?php

use App\Http\Controllers\DivingSignUpController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup/{userid}&{ds_code}', [DivingSignUpController::class, 'index']);

Route::get('/signup/{userid}', [DivingSignUpController::class, 'show']);

