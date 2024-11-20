<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->hasMany(Room::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
