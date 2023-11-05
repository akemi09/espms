<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MfoPap extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function mfo_pap_office()
    {
        return $this->hasMany(MfoPapOffice::class);
    }

    public function mfo_pap_target_type()
    {
        return $this->hasMany(MfoPapTargetType::class);
    }

    public function target_function()
    {
        return $this->belongsTo(TargetFuntion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ipcrs()
    {
        return $this->hasMany(Pcr::class);
    }
}
