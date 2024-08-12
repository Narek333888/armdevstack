<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class PostCategoryText extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatableSlug;

    protected $fillable = [
        'post_category_id',
        'language_id',
        'name',
        'description',
        'seo_url',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected array $translatable = [
        'name',
        'description',
        'seo_url',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    /**
     * @return HasMany
     */
    public function post(): HasMany
    {
        return $this->hasMany(PostCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('seo_url');
    }
}
