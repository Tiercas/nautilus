<?php

use App\Http\Controllers\DiversBySession;
use App\Http\Controllers\DivesList;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ManageAdherentController;
use App\Http\Controllers\DivingNumberController;
use App\Models\DivingNumberModel;
use App\Models\DivingSession;
use App\Http\Controllers\DivingSignUpController;
use App\Http\Controllers\DiveSessionCreation;
use App\Http\Controllers\DiveSessionUpdate;
use App\Http\Controllers\AuthController;
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

use App\Models\User;

Route::get('/login', function ()
{
    return view('login', ['wrongPassword' => false]);
});

Route::post('/login', function (Request $request)
{
    $request->validate([
        'mail' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('US_EMAIL', $request->mail)->first();
    if($user == null)
    {
        return view('login', ['wrongPassword' => true]);
    }
    if($user->checkPassword($request->password))
    {
        return redirect('/'); // TODO: Redirect to the user's hub page
    }
    else
    {
        return view('login', ['wrongPassword' => true]);
    }
});

Route::middleware('App\Http\Middleware\rightChecker')
    ->post('/dive/disable/{id}', function ($id){
    DivingSession::find($id)->disable();
    return redirect('/');
});

Route::get('/dives', [DivesList::class, 'index']);
Route::get('/test', function()
{
    return view('test', ['user' => User::find(1)]);
});

