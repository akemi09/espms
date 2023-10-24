<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mfo_paps()
    {
        return $this->belongsToMany(MfoPap::class, 'mfo_pap_offices')->withTimestamps()->orderBy('id', 'asc');
    }
}
