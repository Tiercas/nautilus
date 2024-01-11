<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivingSignUpModel;

class DivingUnsubscribeController extends Controller
{
    public function index($id)
    {
        $userid = session('user')->US_ID;
        $request = DivingSignUpModel::where('US_ID', $userid)->where('DS_CODE', $id)->delete();
        return redirect('/dives');
    }
}
