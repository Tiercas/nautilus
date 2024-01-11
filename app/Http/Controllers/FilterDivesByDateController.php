<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\View\View;

class DivesByDateList extends Controller
{
    public function index($date): View
    {
        $divesByDate = DivingSession::select('DS_CODE', 'car_diving_session.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME')
            ->join('car_diving_location', 'car_diving_session.DL_ID', '=', 'car_diving_location.DL_ID')
            ->where('DS_DATE', $date)
            ->get();
        return view('divesByDate', ['divesByDate' => $divesByDate]);
    }
}