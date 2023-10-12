<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pcr extends Model
{
    use HasFactory, SoftDeletes;

    public const NEW = 0;
    public const FOR_APPROVAL = 1;
    public const APPROVED = 2;
    public const DISAPPROVED = 3;

    public const BADGE_COLOR = [
        0 => 'dark',
        1 => 'warning',
        2 => 'success',
        3 => 'danger',
    ];

    public const STATUS = [
        0 => 'NEW',
        1 => 'FOR APPROVAL',
        2 => 'APPROVED',
        3 => 'DISAPPROVED',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mfo_pap()
    {
        return $this->belongsTo(MfoPap::class);
    }
}
