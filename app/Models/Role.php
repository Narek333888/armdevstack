<?php

namespace App\Models;

use App\Traits\DiffForHumans;
use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasFactory,
        SoftDeletes,
        Trashable,
        DiffForHumans;
}
