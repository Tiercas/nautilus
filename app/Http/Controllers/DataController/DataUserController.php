<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DataUserController extends Controller
{
    public static function fetch()
    {
        $userData = User::select('US_ID', 'PRE_CODE', 'US_NAME', 'US_FIRST_NAME', 'US_EMAIL', 'US_ADDRESS', 'US_POSTCODE', 'US_TOWN', 'US_SUB_DATE', 'US_SUB_TYPE', 'US_LICENCE_ID', 'US_TEACHING_LEVEL')
        ->get();
        return response()->json([
            'status' => 'success',
            'data' => $userData
        ])->setStatusCode(200);
    }
}
