<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

/**
 * @method static select(string $string, string $string1, string $string2, string $string3, string $string4)
 */
class DivingSession extends Model
{
    protected $table = 'CAR_DIVING_SESSION';
    protected $primaryKey = 'DS_CODE';
    protected $keyType = 'string';
    public $timestamps = false;

    use HasFactory;

    public function getParticipants(): array{
        $registrations = DB::table('CAR_REGISTRATION')->where('DS_CODE', $this->DS_CODE)->get();
        $participants = [];

        foreach($registrations as $registration){
            if($registration->REG_ACTIVE === 1){
                $participants[] = User::find($registration->US_ID);
            }
        }

        return $participants;
    }

    public function disable()
    {
        $this->DS_ACTIVE = 0;
        $this->save();
    }
    public function getDivingGroups(){
        return DivingGroup::where('DS_CODE', $this->DS_CODE)->get();
    }
}
