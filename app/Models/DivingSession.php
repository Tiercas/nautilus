<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingSession extends Model
{
    protected $table = 'car_diving_session';
    protected $primaryKey = 'ds_code';
    protected $keyType = 'string';
    public $timestamps = false;

    /*protected $attributes = [
        'DS_CODE' => 'test'
    ];*/

    use HasFactory;
}
