<?php

use App\Http\Controllers\DivesList;
use App\Models\Boat;
use App\Models\User;
use App\Models\Prerogative;
use Illuminate\Http\Request;
use App\Models\DivingSession;
use App\Models\DivingLocation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiversBySession;
use App\Http\Controllers\DiveSessionUpdate;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DivingNumberController;
use App\Http\Controllers\DivingSignUpController;
use App\Http\Controllers\DiveSessionCreation;
use App\Http\Controllers\ManageAdherentController;
use App\Http\Controllers\DiveSessionDelete;
use App\Http\Controllers\SecuritySheets\PreviewStrategy;
use App\Http\Controllers\SecuritySheets\SecuritySheetController;

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

Route::get('/error', function(){

})->name('error');

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

Route::get('/dives/{ds_code}/security-sheet/test', function($id){
    return (new SecuritySheetController)->setStrategy(new PreviewStrategy)->generate($id);
});

Route::get('/dives/{ds_code}/security-sheet/generate', [SecuritySheetController::class, 'generate']);

Route::get('/dives/{ds_code}', [DivingSignUpController::class, 'index']);

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('/dives/{ds_code}', [DivingSignUpController::class, 'index']);

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('/create/dive', function()
{
    return view('create_dive', ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all()->skip(3), 'users' => User::all(), 'previousDives' => session()->get('previousDives')]);
})->name('create_dive');

Route::middleware('App\Http\Middleware\rightChecker')
    ->post('/create/dive', function(Request $request)
{
    $pre = DiveSessionCreation::add($request);

    error_log($pre);

    if(is_string($pre))
    {
        return view('create_dive', ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all()->skip(3), 'users' => User::all(), 'error' => $pre, 'previousDives' => session()->get('previousDives')]);
    }
    else
    {
        $previousDives = session('previousDives', []);
        $previousDives[] = $pre;

        session(['previousDives' => $previousDives]);
        return view('create_dive',  ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all()->skip(3), 'users' => User::all(), 'precedent' => $pre, 'previousDives' => $previousDives]);
    }

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

Route::post('/dive/delete/{id}', function ($id, Request $request){
    DiveSessionDelete::update($id);
    $previousDives = session('previousDives', []);

    $indexToRemove = array_search($id, array_column($previousDives, 'DS_CODE'));

    if ($indexToRemove !== false) {
        unset($previousDives[$indexToRemove]);
        $previousDives = array_values($previousDives);
        session(['previousDives' => $previousDives]);
    }

    return redirect('/create/dive');
});
Route::get('/sessions', [DiversBySession::class,'getAllSessions']);

Route::get('/session/{ds_code}', [DiversBySession::class,'getDiversBySession']);

Route::get('/divings', [DivingNumberController::class, 'index'])->name('divings');

Route::get('/alldivings', [DivingNumberController::class, 'allIndex'])->name('alldivings');

Route::get('/alldivings?{afterthe}&{beforethe}', [DivingNumberController::class, 'filteredSearch({afterthe}, {beforethe})']);

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('manage/members', [ManageAdherentController::class, 'index'])
    ->name('manage_members');

Route::middleware('App\Http\Middleware\rightChecker')
    ->post('manage/members/roles', [ManageAdherentController::class, 'update'])
    ->name('updateMembersRole');

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('dive/{id}', [DivesList::class, 'show'])
    ->name('dives_show');

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('manage/dives', [DivesList::class, 'showManagementList'])
->name('manage_dives_dir');
