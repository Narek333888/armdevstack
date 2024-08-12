<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Trash extends Model
{
    use HasFactory;

    protected $table = 'trash';

    protected $fillable = [
        'trashable_type',
        'trashable_id',
        'deleted_at'
    ];

    /**
     * @return MorphTo
     */
    public function trashable(): MorphTo
    {
        return $this->morphTo();
    }
}
