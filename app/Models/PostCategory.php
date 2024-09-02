<?php

namespace App\Models;

use App\Traits\DiffForHumans;
use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $image
 * @property integer $active
 */
class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Trashable, DiffForHumans;

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
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'category_post')->withTimestamps();
    }
}
