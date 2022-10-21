<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function computer() {
        return $this->hasMany(Computer::class);
    }

    public function network() {
        return $this->hasMany(Network::class);
    }
}
