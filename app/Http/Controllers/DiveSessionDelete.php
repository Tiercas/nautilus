<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\Http\Request;

class DiveSessionDelete extends Controller
{
    //

    public static function update($id)
    {
        $dv = DivingSession::where('DS_CODE', $id)->first();
        $dv->DS_ACTIVE = 0;
        $dv->save();
    }
}
