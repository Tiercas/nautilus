<?php

namespace App\Http\Controllers;

use App\Models\DivingGroup;
use App\Models\DivingLocation;
use App\Models\DivingSession;
use App\Models\Prerogative;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivesList extends Controller
{
    function index(): View
    {
        $dives = DivingSession::select('DS_CODE', 'DS_ACTIVE', 'CAR_DIVING_SESSION.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME', 'DS_MAX_DEPTH' ,'DS_DIVERS_COUNT' , 'DS_MAX_DIVERS')
            ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
            ->where('DS_ACTIVE', 1)
            ->orderBy('DS_DATE', 'asc')
            ->get();
        $user = session()->get('user');
        $locations = DivingLocation::all();
        $levels = Prerogative::select('PRE_MAX_DEPTH')->groupby('PRE_MAX_DEPTH')->get();
        return view('dives', ['dives' => $dives, 'userPre' => Prerogative::find($user->PRE_CODE), 'locations' => $locations, 'levels' => $levels]);
    }

    function show($id) {
        $divingSession = DivingSession::join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
            ->join('CAR_BOAT', 'CAR_DIVING_SESSION.BO_ID', '=', 'CAR_BOAT.BO_ID')
            ->where('DS_CODE', '=', $id)
            ->first();
        if($divingSession === null) return redirect()->route('homepage');
        $creator = User::find($divingSession->US_ID);
        $security = User::find($divingSession->US_ID_CAR_SECURE);
        $director = User::find($divingSession->US_ID_CAR_DIRECT);
        $divingSession->DS_DATE = strftime('%d/%m/%Y', strtotime($divingSession->DS_DATE));
        return view('dive_infos_palanque', ['dive' => $divingSession, 'divers' => $divingSession->getParticipants(), 'creator' => $creator, 'security' => $security, 'director' => $director]);
    }

    function showManagementList() {
        $userID = session('user')->US_ID;
        $dives = DivingSession::select('DS_CODE', 'DS_ACTIVE', 'CAR_DIVING_SESSION.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME', 'DS_MAX_DEPTH')
            ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
            ->where('DS_ACTIVE', '=', 1, 'and', 'DS_DATE', '>=', date('Y-m-d'), 'and', 'US_ID_CAR_DIRECT', '=', $userID)
            ->orderBy('DS_DATE', 'asc')
            ->get();
        return view('dives_list_management', ['dives' => $dives]);
    }

    function filter(Request $request) {
        $location = $request->input('location_filter');
        $creneau = $request->input('creneau_filter');
        $level = $request->input('level_filter');
        $date = $request->input('date_filter');
        //dd($location, $creneau, $level, $date);

        $dives = DivingSession::select('DS_CODE', 'DS_ACTIVE', 'CAR_DIVING_SESSION.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME', 'DS_MAX_DEPTH')
            ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
            ->where('DS_ACTIVE', 1);

        if ($location != null && $location != 'default') {
            $dl_id = DivingLocation::where('DL_NAME', $location)->first()->DL_ID;
            $dives = $dives->where('CAR_DIVING_SESSION.DL_ID', $dl_id);
        }
        if ($creneau != null && $creneau != 'default') {
            $dives = $dives->where('CAR_SCHEDULE', $creneau);
        }
        if ($level != null && $level != 'default') {
            $dives = $dives->where('DS_MAX_DEPTH', '<=', intval($level));
        }
        if ($date != null && $date != 'default') {
            $dives = $dives->where('DS_DATE', '>=', $date);
        }
        $dives = $dives->orderBy('DS_DATE', 'asc')->get();
        $user = session()->get('user');
        $locations = DivingLocation::all();
        $levels = Prerogative::select('PRE_MAX_DEPTH')->groupby('PRE_MAX_DEPTH')->get();
        return view('dives', ['dives' => $dives, 'userPre' => Prerogative::find($user->PRE_CODE), 'locations' => $locations, 'levels' => $levels]);
    }
}
