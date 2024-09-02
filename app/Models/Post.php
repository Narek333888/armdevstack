<?php

namespace App\Models;

use App\Traits\DiffForHumans;
use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $created_at
 */
class Post extends Model
{
    use HasFactory, SoftDeletes, Trashable, DiffForHumans;

    protected $fillable = [
        'active',
        'youtube_url',
        'image',
        'image_original_name',
    ];

    /**
     * @return HasOne
     */
    public function postText(): HasOne
    {
        return $this->hasOne(PostText::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'category_post')->withTimestamps();
    }
}
