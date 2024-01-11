<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivingSession;

class fileSecurityController extends Controller
{
    function index(): View
    {
        $files = DivingSession::sessionsWithFilledFile();

        return view('sessionlist',['sessions' => $files]);
    }
}
