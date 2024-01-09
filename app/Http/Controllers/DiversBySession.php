<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;


class DiversBySession extends Controller
{
    public function getDiversBySession($ds_code): View
    {
        $parametre = $ds_code;
        $request = User::selectRaw('US_NAME, US_FIRST_NAME')
        ->join('CAR_REGISTRATION','CAR_REGISTRATION.US_ID', '=', 'CAR_USER.US_ID')
        ->where('DS_CODE', $ds_code)
        ->get();

        return view('diversonesession', ['datas' => $request, 'parametre' => $parametre]);
    }
    
    public function getAllSessions(): View
    {
        $sessions = User::
        join('CAR_REGISTRATION', 'CAR_REGISTRATION.US_ID', '=', 'CAR_USER.US_ID')
        ->get();
    
    return view('diversinsessions', compact('sessions'));
    
    }
}
