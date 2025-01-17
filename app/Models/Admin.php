<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use  Notifiable;
    protected $fillable = ["name", "email", "password","username","remember_token","role_id"];

    public function roles()
    {
        return $this->belongsTo(Role::class,"role_id");
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hasPermission($permissionName)
    {
        $role = $this->roles;

        if ($role) {
            $permissions = $role->permissions;

            // Check if the permission exists in the array
            if (is_array($permissions) && in_array($permissionName, $permissions)) {
                return true;
            }
        }

        return false;
    }

public function receivesBroadcastNotificationsOn() : string
{
    return "admins".$this->id;
}


}

