<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        // id table users
        // user_id table roles
        return $this->hasMany(User::class);

        // กรณีตั้งค่า relation ไม่ตรงตามหลักของ laravel ต้องระบุ key ให้ด้วย
        // userid table roles
        // id table users
        // $this->hasMany(related,foreignKey,localKey)
        // return $this->hasMany(User::class,'userid','id')
    }


}
