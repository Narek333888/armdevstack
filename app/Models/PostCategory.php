<?php

namespace App\Models;

use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property mixed $image
 * @property integer $active
 */
class PostCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Trashable;

    protected $fillable = [
        'is_active',
        'image',
        'image_original_name',
    ];

    /**
     * @return HasOne
     */
    public function postCategoryText(): HasOne
    {
        return $this->hasOne(PostCategoryText::class);
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
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'category_post')->withTimestamps();
    }
}
