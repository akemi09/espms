<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarRange extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}
