<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingSignUpModel extends Model
{
    protected $table = 'CAR_REGISTRATION';
<<<<<<< HEAD
    protected $primaryKey = ['us_id', 'ds_code'];
=======
    protected $primaryKey = ['US_ID', 'DS_CODE'];
>>>>>>> diversbysession
    protected $keyType = ['int', 'string'];
    protected $fillable = ['US_ID', 'DS_CODE', 'REG_ACTIVE'];
    use HasFactory;
}
