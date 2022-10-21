<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function desktop() {
        return $this->hasMany(Desktop::class);
    }

    public function peripheral() {
        return $this->hasMany(Peripheral::class);
    }

    public function software() {
        return $this->hasMany(Software::class);
    }

    public function utility() {
        return $this->hasMany(Utility::class);
    }

    public function maintenancelog() {
        return $this->hasMany(MaintenanceLog::class);
    }
}
