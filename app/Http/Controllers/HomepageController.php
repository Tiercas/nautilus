<?php

namespace App\Http\Controllers;

use App\Models\RoleAttribution;
use Illuminate\View\View;

class HomepageController extends Controller
{
    function index(): View {
        if (!session()->has('user')) return view('dashboard');
        $roles = RoleAttribution::where('US_ID', '=', session('user')->US_ID)->get();
        $highestRole = 'VIS';
        if ($roles == null) return view('dashboard');
        else $highestRole = array('DIV');
        foreach ($roles as $role) {
            array_push($highestRole, $role->ROL_CODE);
        }
        return view('dashboard', ['highestRole' => $highestRole]);
    }
}
