<?php

namespace App\Http\Controllers;

use App\Models\DivingGroup;
use App\Models\DivingSignUpModel;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManualPalanqueeController extends Controller
{
    public function store(Request $request){
        try {
            $divingGroups = $request->json()->all();
            $ds_code = end($divingGroups);
            $maxDG = DivingGroup::select()->where('DS_CODE', $ds_code)->max('DG_NUMBER');
            if($maxDG == null)
                $maxDG = 1;
            else
                $maxDG += 1;

            for($i = 0; $i < count($divingGroups) - 1; $i++) {
                $divingNumber = $i + 1;
                if($divingNumber >= $maxDG){
                    Log::info('Creating diving group ' . $maxDG . ' for diving session ' . $ds_code);
                    DivingGroup::insert(['DS_CODE' => $ds_code, 'DG_NUMBER' => $maxDG]);
                    $maxDG += 1;
                }

                foreach($divingGroups[$i] as $diver){
                    Log::info('Adding diver ' . $diver . ' to diving group ' . $divingNumber . ' for diving session ' . $ds_code);
                    $update = DivingSignUpModel::where('US_ID', $diver)
                        ->where('DS_CODE', $ds_code)->update(['DG_NUMBER' => $divingNumber]);
                }
            }
            $responseData = ['message' => 'Data received successfully', 'additionalData' => $divingGroups];
            return response()->json($responseData);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Internal Server Error', 'errData' => $e], 500);
        }
    }
}
