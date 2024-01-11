<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\Http\Request;

class DiveSessionDelete extends Controller
{
    //

    public static function update($id)
    {
        $dv = DivingSession::find($id);
        $dv->DS_ACTIVE = 0;
        $dv->save();
    }
}
