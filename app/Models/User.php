<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'CAR_USER';

    protected $primaryKey = 'US_ID';

    /**
     * Check if a given password matches the stored password.
     *
     * @param string $password the password to try
     * @return bool true if the password matches, false otherwise
     */
    public function checkPassword($password)
    {
        if($password == $this->US_PASSWORD)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the roles attributed to the user.
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class, RoleAttribution::class, 'US_ID', 'ROL_CODE');
    }

    public function getRole() {
        return User::select('CAR_ROLE.ROL_LABEL')
            ->join('CAR_ROLE_ATTRIBUTION', 'CAR_USER.US_ID', '=', 'CAR_ROLE_ATTRIBUTION.US_ID')
            ->join('CAR_ROLE', 'CAR_ROLE_ATTRIBUTION.ROL_CODE', '=', 'CAR_ROLE.ROL_CODE')
            ->where('CAR_USER.US_ID',session('user')->US_ID)
            ->pluck('CAR_ROLE.ROL_LABEL')
            ->first();    }
    
    
    

    /**
     * Check if the user has a given role.
     *
     * @param string $roleCode the code of the role to check
     * @return bool true if the user has the role, false otherwise
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $keyType = 'int';
    public function hasRole($roleCode)
    {
        return $this->roles->contains('ROL_CODE', $roleCode);
    }


    

}


