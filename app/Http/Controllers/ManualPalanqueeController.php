<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManualPalanqueeController extends Controller
{
    public function show(){
        $token = csrf_token();
        return view('palanque_manuel', compact('token'));
    }

    public function index(){
        
    }

    public function store(Request $request){
        $data = $request->json()->all();
        return response()->json(['message' => 'Data received successfully'], 200);
    }
}
