<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HeaderController extends Controller
{
    function index(): View
    {
        $roles = User::getRole();
        return view('components/header', ['roles' =>$roles]);
    }
}
