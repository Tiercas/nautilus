<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use App\Models\Registration;

class DataRegistrationController extends Controller
{
    public static function fetch()
    {
        $prerogative = Registration::all();
        return $prerogative;
    }
}
