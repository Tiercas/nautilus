<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prerogative extends Model
{
    use HasFactory;
    protected $table = 'CAR_PREROGATIVE';

    protected $primaryKey = 'PRE_CODE';
    protected $keyType = 'string';

}
