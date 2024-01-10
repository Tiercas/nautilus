<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageAdherentController extends Controller {
    function index() {
        return view('manageAdherent');
    }
}
