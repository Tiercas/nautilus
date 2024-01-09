<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingLocation extends Model
{
    use HasFactory;

    protected $table = 'CAR_DIVING_LOCATION';

    protected $primaryKey = 'DL_ID';
}
