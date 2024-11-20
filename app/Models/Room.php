<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    // protected $table = 'room';

    public function members()
    {
        return $this->hasMany(Member::class);
    }


    public function services()
    {
        return $this->hasMany(Service::class,'id','service_id');
    }
}
