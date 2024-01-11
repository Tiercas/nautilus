<?php

use App\Http\Controllers\DivesList;
use App\Http\Controllers\ManualPalanqueeController;
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
use App\Http\Controllers\AdherentController;
use App\Http\Controllers\DivingSignUpController;
use App\Http\Controllers\DiveSessionCreation;
use App\Http\Controllers\ManageAdherentController;
use App\Http\Controllers\DiveSessionDelete;
use App\Http\Controllers\DivingUnsubscribeController;
use App\Http\Controllers\DiveDeletion;
use App\Http\Controllers\DivesListManage;
use App\Http\Controllers\ModificationDives;
use App\Http\Controllers\DiveCreation;
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

Route::get('/error', function () {

})->name('error');

/**
 * Leads to the sign-in page.
 */
Route::get('/login', function () {
    return view('login', ['wrongPassword' => false]);
})->name('login');

/**
 * Tries to log the user in from a form they just filled.
 */
Route::post('/login', [AuthController::class, 'login']);

/**
 * Leads to the homepage of the site.
 */
Route::get('/', [HomepageController::class, 'index'])->name('homepage');

/**
 * Logs the user out and redirects them to the homepage.
 */
Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

/**
 * Leads to a page for listing and registering for diving sessions.
 * Only accessible to logged in divers.
 */
Route::middleware('App\Http\Middleware\RightChecker')
    ->get('/dives', [DivingSignUpController::class, 'show'])
    ->name('dives');

Route::middleware('App\Http\Middleware\RightChecker')
    ->post('/dives/filter', [DivesList::class, 'filter'])
    ->name('dives_filter');

Route::get('/test', function () {
    return view('test');
});

/**
 * Leads to a preview page of a security sheet for a particular diving session.
 * @param $ds_code the code of the diving session
 */
Route::get('/dives/{ds_code}/security-sheet/test', function ($ds_code) {
    return (new SecuritySheetController)->setStrategy(new PreviewStrategy)->generate($ds_code);
});

/**
 * Generate a pdf security sheet and stores it at /security-sheets/fiche-securite-{ds_code}.pdf
 * @param $ds_code the code of the diving session
 */
Route::get('/dives/{ds_code}/security-sheet/generate', [SecuritySheetController::class, 'generate']);

/**
 * Leads to a page that allows to edit a security sheet and generate it again.
 */
Route::get('/dives/{ds_code}/security-sheet/edit', [SecuritySheetController::class, 'edit']);

/**
 * Updates the security sheet and generates it again.
 * @param $ds_code the code of the diving session
 */
Route::post('/dives/{ds_code}/security-sheet/update', [SecuritySheetController::class, 'update']);

/**
 * Tries to register the user to a diving session.
 * Redirects to /dives afterhand.
 * Only accessible to a registered diver.
 * @param $ds_code the code of the diving session
 */
Route::middleware('App\Http\Middleware\RightChecker')
    ->get('/dives/{ds_code}', [DivingSignUpController::class, 'index']);

/**
 * Leads to the dive creation page.
 * Only accessible to the diving section manager.
 */
Route::middleware('App\Http\Middleware\RightChecker')
    ->get('/create/dive', function () {
        return view('create_dive', ['locations' => DivingLocation::all(), 'boats' => Boat::all(), 'levels' => Prerogative::all()->skip(3), 'users' => User::all(), 'previousDives' => session()->get('previousDives')]);
    })->name('create_dive');

/**
 * Stores the new diving session on the database from a form filled by the diving section manager.
 * Only accessible to the diving section manager.
 */
Route::middleware('App\Http\Middleware\RightChecker')
    ->post('/create/dive', function (Request $request) {
        return DiveCreation::index($request);
    });

/**
 * Leads to the diving session editing page.
 * @param $id the code of the diving session
 */

//TODO make accessible only to diving section manager.
Route::middleware('App\Http\Middleware\RightChecker')
    ->get('/dive/update/{id}', function ($id) {
        return view('update_dive', ['dive' => DivingSession::find($id),
            'locations' => DivingLocation::all(),
            'boats' => Boat::all(),
            'levels' => Prerogative::all(),
            'users' => User::all()]);
    });

/**
 * Updates a diving session.
 * @param $id the code of the diving session
 */
Route::post('/dive/update/{id}', function ($id, Request $request){
    $error = DiveSessionUpdate::update($request, $id);

    if($error != null)
    {
        return view('update_dive', ['dive' => DivingSession::find($id),
                    'locations' => DivingLocation::all(),
                    'boats' => Boat::all(),
                    'levels' => Prerogative::all(),
                    'users' => User::all(),
                    'error' => $error]);
    }
    return redirect('/');
});

/**
 * Cancels a diving session (does not delete it).
 * @param $id the code of the diving session
 */
Route::middleware('App\Http\Middleware\RightChecker')
    ->post('/dive/disable/{id}', function ($id)
    {
        $res = DivingSession::disable($id);
        if($res !== null)
        {
            return view('update_dive', ['dive' => DivingSession::find($id),
            'locations' => DivingLocation::all(),
            'boats' => Boat::all(),
            'levels' => Prerogative::all(),
            'users' => User::all(),
            'error' => $res]);
        }
        return redirect('/');
    });

/**
 * Delete a diving session.
 * @param $id the code of the diving session
 */
Route::post('/dive/delete/{id}', function ($id, Request $request) {
    return redirect('/create/dive');
});

/**
 * List all the diving sessions of all the users.
 */
Route::get('/sessions', [DiversBySession::class, 'getAllSessions']);

Route::get('/session/{ds_code}', [DiversBySession::class, 'getDiversBySession']);

/**
 * List all the diving sessions of the user, as well as its remaining sessions for the current year.
 */
Route::get('/divings', [DivingNumberController::class, 'index'])->name('divings');

/**
 * Leads to a page that shows each divers and their number and allows to select a period.
 */
Route::get('/alldivings', [DivingNumberController::class, 'allIndex'])->name('alldivings');

/**
 * Leads to a page that show each divers and their number of diving sessions for the selected period (not set by default).
 * @param $afterthe the first day of the filtering period (if unset, the page will show divings until the "before" date)
 * @param $beforethe the last day of the filtering period (if unset, the page will show divings starting from the "after" date)
 */
Route::get('/alldivings?{afterthe}&{beforethe}', [DivingNumberController::class, 'filteredSearch({afterthe}, {beforethe})']);

/**
 * Leads to a page that allows to manage every member and change their roles.
 * Only accessible to the diving section manager.
 */
Route::middleware('App\Http\Middleware\rightChecker')
    ->get('manage/members', [ManageAdherentController::class, 'index'])
    ->name('manage_members');

/**
 * Updates every user's roles.
 * Only accessible to the diving section manager.
 */
Route::middleware('App\Http\Middleware\rightChecker')
    ->post('manage/members/roles', [ManageAdherentController::class, 'update'])
    ->name('updateMembersRole');

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('dive/{id}', [DivesList::class, 'show'])
    ->name('dives_show');

Route::middleware('App\Http\Middleware\rightChecker')
    ->get('manage/dives', [DivesList::class, 'showManagementList'])
->name('manage_dives_dir');
Route::get('/modificationdives', [ModificationDives::class, 'index']);

Route::get('modificationdives/members/{ds_code}', function($ds_code){

    return ModificationDives::modificationMembers($ds_code);
});


Route::post('modificationdives/members/{ds_code}/deletiondiver/{us_id}', function($ds_code, $us_id){
     return ModificationDives::removalOfAMemberFromASession($ds_code, $us_id);
});



Route::get('/modificationdives/members/{ds_code}/ajoutadherent/{pre_code}', function($ds_code, $pre_code){
    return AdherentController::index($ds_code, $pre_code);
});

Route::post('/modificationdives/members/{ds_code}/ajoutadherent/{us_id}', function($ds_code, $us_id){
    return AdherentController::addUserToDive($ds_code, $us_id);
});

Route::get('/modificationdives/members/{ds_code}/ajoutadherent/{pre_code}', [AdherentController::class, 'searchByName']);

Route::get('/palanque/manuelle', [ManualPalanqueeController::class, 'show'])->name('palanque_manuelle');
