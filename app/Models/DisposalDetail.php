<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposalDetail extends Model
{
    use HasFactory;

    public function disposalArchive() {
        return $this->belongsTo(DisposalArchive::class);
    }
}
