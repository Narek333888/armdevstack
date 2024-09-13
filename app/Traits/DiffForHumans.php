<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

trait DiffForHumans
{
    /**
     * @return Attribute
     */
    protected function createdAtDiff(): Attribute
    {
        return Attribute::make(get: fn() => $this->created_at ? Carbon::parse($this->created_at)->diffForHumans() : null);
    }

    /**
     * @return Attribute
     */
    protected function updatedAtAtDiff(): Attribute
    {
        return Attribute::make(get: fn() => $this->updated_at ? Carbon::parse($this->updated_at)->diffForHumans() : null);
    }
}
