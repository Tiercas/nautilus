<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivingSession;
use Illuminate\View\View;


class fileSecurityController extends Controller
{
    function index(): View
    {
        $files = DivingSession::sessionsWithFilledFile();

        return view('sessionslist',['sessions' => $files]);
    }

    function indexWithId(): View
    {
        $files = DivingSession::sessionsWithFilledFileWithId();

        return view('sessionslistid',['sessions' => $files]);
    }
}
