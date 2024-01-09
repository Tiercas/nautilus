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

Route::get('/plongees/{id}', function($id){
    $divingSession = DivingSession::find($id);
    return view('divingSessions.showParticipants',[
        'users' => $divingSession->getParticipants()
    ]);
});
