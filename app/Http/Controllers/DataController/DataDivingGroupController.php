<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DivingGroup;

class DataDivingGroupController extends Controller
{
    public static function fetch()
    {
        $divingGroupData = DivingGroup::all();
        return response()->json([
            'status' => 'success',
            'data' => $divingGroupData
        ])->setStatusCode(200);
    }
}
