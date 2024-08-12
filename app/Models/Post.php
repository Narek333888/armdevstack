<?php

namespace App\Models;

use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property mixed $created_at
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Trashable;

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
     * @return Attribute
     */
    protected function createdAtDiff(): Attribute
    {
        return Attribute::make(get: fn() => Carbon::parse($this->created_at)->diffForHumans());
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'category_post')->withTimestamps();
    }
}
