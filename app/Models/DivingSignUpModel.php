<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingSignUpModel extends Model
{
    protected $table = 'car_registration';
    protected $primaryKey = ['us_id', 'ds_code'];
    protected $keyType = ['int', 'string'];
    protected $fillable = ['US_ID', 'DS_CODE', 'REG_ACTIVE'];
    use HasFactory;
}
