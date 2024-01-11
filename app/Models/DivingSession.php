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

    protected $guarded = [];

    use HasFactory;

    static public function sessionsWithFilledFile():array
    {
        $res =  DB::table('CAR_DIVING_SESSION')->where('DS_FILE_FILLED', 1)->get();
        return $res->toArray();
    }

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

    public function getDivingGroups(){
        return DivingGroup::where('DS_CODE', $this->DS_CODE)->get();
    }

    public function disable()
    {
        $this->DS_ACTIVE = 0;
        $this->save();
    }

    public function getRoleForUser(User $user){
        if($user->US_ID === $this->US_ID_CAR_DIRECT){
            return "Directeur de plongée";
        }

        if($user->US_ID === $this->US_ID){
            return "Pilote";
        }

        if($user->US_ID === $this->US_ID_CAR_SECURE){
            return "Sécurité de surface";
        }

        if($user->US_TEACHING_LEVEL > 0){
            return "Encadrant";
        }

        if(strpos($user->PRE_CODE, 'GP')){
            return "Guide de palanquée";
        }
        
        return "Plongeur";
    }

    
}
