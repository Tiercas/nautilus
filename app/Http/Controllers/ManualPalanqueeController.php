<?php

namespace App\Http\Controllers;

use App\Models\DivingGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManualPalanqueeController extends Controller
{
    public function show(){
        $token = csrf_token();
        return view('palanque_manuel', compact('token'));
    }

    public function index(){
        
    }

    public function store(Request $request){
        try {
            $data = $request->json()->all();
            DB::insert('insert into CAR_DIVING_GROUP (DS_CODE, DG_NUMBER) values (?,?)', ['200', '200']);
            $responseData = ['message' => 'Data received successfully', 'additionalData' => $data[count($data) - 1]];
            return response()->json($responseData);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function test(){
        
    }
}
