<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
