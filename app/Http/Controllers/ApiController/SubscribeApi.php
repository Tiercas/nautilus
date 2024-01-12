<?php

namespace App\Http\Controllers\ApiController;

use App\Models\DivingSession;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DivingSignUpModel;
use App\Http\Controllers\Controller;

class SubscribeApi extends Controller
{
    public static function subscribe(Request $request)
    {
        if(($request->US_ID==null) && ($request->DS_CODE==  null))
        {
            return response()->json([
                'status' => 'failed',
                'message' => 'Missing essential parameters'
            ])->setStatusCode(500);
        }
        else
        {
            if(User::find($request->US_ID))
            {
                if(DivingSession::find($request->DS_CODE))
                {
                    DivingSignUpModel::insert(['US_ID' => $request->US_ID, 'DS_CODE' => $request->DS_CODE, 'REG_ACTIVE' => 1]);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Diving session subscribed'
                    ])->setStatusCode(200);
                }
                else
                {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Diving session not found'
                    ])->setStatusCode(500);
                }
            }
            else
            {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User not found'
                ])->setStatusCode(500);
            }
        }
    }
}
