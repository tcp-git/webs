<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    // protected $table = 'organization';

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
