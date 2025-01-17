<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ["name","permissions"];

    public function getPermissionsAttribute($value)
    {
        return json_decode($value);
    }
    public function admins()
    {
        return $this->hasMany(Admin::class,'role_id');
    }
    protected $casts = [
        'permissions' => 'array',
    ];
}
