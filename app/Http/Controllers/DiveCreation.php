<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivingSession;
use App\Models\DivingLocation;
use App\Models\Boat;
use App\Models\Prerogative;
use App\Models\User;

class DiveCreation extends Controller
{
    public static function index(Request $request)
    {
        $pre = DiveSessionCreation::add($request);

        error_log($pre);

        if(is_string($pre))
        {
            return view('create_dive', ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all()->skip(3), 'users' => User::all(), 'error' => $pre, 'previousDives' => session()->get('previousDives')]);
        }
        else
        {
            $previousDives = session('previousDives', []);
            $previousDives[] = $pre;

            session(['previousDives' => $previousDives]);
            return view('create_dive',  ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all()->skip(3), 'users' => User::all(), 'precedent' => $pre, 'previousDives' => $previousDives]);
        }

    }
}
