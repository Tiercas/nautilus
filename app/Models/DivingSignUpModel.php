<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingSignUpModel extends Model
{
    protected $table = 'CAR_REGISTRATION';
    protected $fillable = ['US_ID', 'DS_CODE', 'REG_ACTIVE'];
    use HasFactory;
}
