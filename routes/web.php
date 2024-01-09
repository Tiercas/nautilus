<?php

use App\Http\Controllers\DivesList;
use App\Models\DivingSession;
use App\Http\Controllers\DivingSignUpController;
use App\Http\Controllers\DiveSessionCreation;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

use App\Models\User;
use App\Models\DivingLocation;
use App\Models\Boat;
use App\Models\Prerogative;


Route::get('/login', function ()
{
    return view('login', ['wrongPassword' => false]);
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function ()
{
    return view('welcome');
})->name('homepage');


Route::middleware('auth:sanctum')->get('/dives', [DivingSignUpController::class, 'show'])->name('dives');

Route::get('/test', function()
{
    return view('test', ['user' => User::find(1)]);
});

Route::get('/dives/list-divers/{id}', function($id){
    return view('divingSessions.showParticipants', [
        'users' => DivingSession::find($id)->getParticipants()
    ]);
});

Route::get('/dives/{ds_code}', [DivingSignUpController::class, 'index']);

Route::get('/create/dive', function()
{
    return view('create_dive', ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all(), 'users' => User::all()]);
});

Route::post('/create/dive', function(Request $request)
{
    DiveSessionCreation::add($request);
    return redirect('/');
});

Route::get('/test2', function(){
    return view('drag_and_drop');
});
