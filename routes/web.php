<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dives', function () {
    $dives = DivingSession::select('car_diving_session.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME')
        ->join('car_diving_location', 'car_diving_session.DL_ID', '=', 'car_diving_location.DL_ID')
        ->get();
    //$divers =
    return view('dives', ['dives' => $dives]);
});
