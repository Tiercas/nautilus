<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiversListBySession extends Model
{
    protected $table = 'CAR_REGISTRATION';
    protected $primaryKey = ['us_id', 'ds_code'];
    use HasFactory;
}
