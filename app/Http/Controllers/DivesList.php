<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use App\Models\Prerogative;
use App\Models\User;
use Error;
use Illuminate\View\View;

class DivesList extends Controller
{
    function index(): View
    {
        $dives = DivingSession::select('DS_CODE', 'DS_ACTIVE', 'CAR_DIVING_SESSION.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME', 'DS_MAX_DEPTH')
            ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
            ->where('DS_ACTIVE', 1)
            ->orderBy('DS_DATE', 'asc')
            ->get();
        $user = session()->get('user');
        return view('dives', ['dives' => $dives, 'userPre' => Prerogative::find($user->PRE_CODE)]);
    }
}
