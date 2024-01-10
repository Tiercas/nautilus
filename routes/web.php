<?php

use App\Http\Controllers\DiversBySession;
use App\Http\Controllers\DivesList;
use App\Http\Controllers\HomepageController;
use App\Models\DivingSession;
use App\Http\Controllers\AdherentController;
use App\Http\Controllers\DivingSignUpController;
use App\Http\Controllers\DiveSessionCreation;
use App\Http\Controllers\DiveSessionUpdate;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModificationDives;
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


Route::get('/login', function () {
    return view('login', ['wrongPassword' => false]);
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');


Route::middleware('App\Http\Middleware\rightChecker')
    ->get('/dives', [DivingSignUpController::class, 'show'])
    ->name('dives');

Route::get('/test', function() {
    return view('test');
});

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('/dives/list-divers/{id}', function($id){
    return view('divingSessions.showParticipants', [
        'users' => DivingSession::find($id)->getParticipants()
    ]);
});

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('/dives/{ds_code}', [DivingSignUpController::class, 'index']);

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('/create/dive', function()
{
    return view('create_dive', ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all(), 'users' => User::all()]);
})->name('create_dive');

Route::middleware('App\Http\Middleware\rightChecker')
    ->post('/create/dive', function(Request $request)
{
    $pre = DiveSessionCreation::add($request);
    return view('create_dive',  ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all(), 'users' => User::all(), 'precedent' => $pre]);
});

Route::get('/tewst2', function(){
    return view('drag_and_drop');
});

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('/dive/update/{id}', function($id){
    return view('update_dive', ['dive' => DivingSession::find($id),
                'locations' => DivingLocation::all(),
                'boats' => Boat::all(),
                'levels' => Prerogative::all(),
                'users' => User::all()]);
});

Route::post('/dive/update/{id}', function($id, Request $request){
        DiveSessionUpdate::update($request, $id);
        return redirect('/');
});

Route::middleware('App\Http\Middleware\rightChecker')
    ->post('/dive/disable/{id}', function ($id){
    DivingSession::find($id)->disable();
    return redirect('/');
});

Route::get('/sessions', [DiversBySession::class,'getAllSessions']);

Route::get('/session/{ds_code}', [DiversBySession::class,'getDiversBySession']);

Route::get('/modificationdives', [ModificationDives::class, 'index']);

Route::get('modificationdives/members/{ds_code}', function($ds_code){
    
    return ModificationDives::modificationMembers($ds_code);
});

Route::post('modificationdives/members/{ds_code}/deletion/{us_id}', function($ds_code, $us_id){
     return ModificationDives::removalOfAMemberFromASession($ds_code, $us_id);
});

Route::get('/adherents/{level}', function($level){
    return AdherentController::index($level);
});