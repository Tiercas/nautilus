<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DivingSession;

class DataDivingSessionController extends Controller
{
    public static function fetch()
    {
        $divingSessionData = DivingSession::all();
        return $divingSessionData;
    }
}
