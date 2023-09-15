<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MfoPapOffice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mfo_pap()
    {
        return $this->belongsTo(MfoPap::class);
    }
}
