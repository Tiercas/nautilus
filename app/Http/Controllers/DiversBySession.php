<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiversListBySession;

class DiversBySession extends Controller
{
    public function getDiversBySession(): View
    {
        $request = DiversListBySession::selectRaw('US_NAME, US_FIRST_NAME, DS_CODE')
        ->join('CAR_REGISTRATION','CAR_USER.US_ID','=','CAR_REGISTRATION.US_ID')
        ->groupBy('DS_CODE')
        ->get();

        return view('diversinsessions', ['datas' => $request]);
    }

    public function getAllSessions(): View
    {
        $request = DiversListBySession::selectRaw('DS_CODE')
        ->get();
        return view('diversinsessions',['sessions' => $request]);
    }
}
