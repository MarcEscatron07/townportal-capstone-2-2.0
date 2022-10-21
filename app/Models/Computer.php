<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function desktop() {
        return $this->hasOne(Desktop::class);
    }

    public function peripheral() {
        return $this->hasMany(Peripheral::class);
    }

    public function software() {
        return $this->belongsToMany(Software::class)->withPivot('column 1', 'column 2')->withTimestamps();
    }

    public function utility() {
        return $this->hasOne(Utility::class);
    }
}
