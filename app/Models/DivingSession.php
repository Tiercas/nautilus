<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string, string $string1, string $string2, string $string3, string $string4)
 */
class DivingSession extends Model
{
    protected $table = 'CAR_DIVING_SESSION';
    protected $primaryKey = 'ds_code';
    protected $keyType = 'string';
    public $timestamps = false;

    /*protected $attributes = [
        'DS_CODE' => 'test'
    ];*/

    use HasFactory;
}
