<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingNumberModel extends Model
{
    protected $table = "CAR_USER";
    protected $primaryKey = "US_ID";
    protected $type = "int"; 
    use HasFactory;
}
