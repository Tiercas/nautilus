<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingSignUpModel extends Model
{
    protected $table = 'car_registration';
    
    protected $fillable = ['US_ID', 'DS_CODE'];
    use HasFactory;
}
