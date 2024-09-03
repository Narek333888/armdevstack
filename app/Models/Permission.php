<?php

namespace App\Models;

use App\Traits\DiffForHumans;
use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as BasePermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends BasePermission
{
    use HasFactory,
        SoftDeletes,
        Trashable,
        DiffForHumans;
}
