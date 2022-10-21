<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desktop extends Model
{
    use HasFactory, SoftDeletes;

    public function computer() {
        return $this->belongsTo(Computer::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
