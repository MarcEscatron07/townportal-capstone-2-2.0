<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposalArchive extends Model
{
    use HasFactory;

    public function disposalDetail() {
        return $this->hasOne(DisposalDetail::class);
    }
}
