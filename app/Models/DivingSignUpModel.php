<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingSignUpModel extends Model
{
    protected $table = 'CAR_REGISTRATION';
    protected $primaryKey = ['US_ID', 'DS_CODE'];
    protected $keyType = ['int', 'string'];
    protected $fillable = ['US_ID', 'DS_CODE'];
    use HasFactory;
}
