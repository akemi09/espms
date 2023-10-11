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

    protected $guarded = [];
}
