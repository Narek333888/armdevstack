<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class PostText extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatableSlug;

    protected $fillable = [
        'post_id',
        'language_id',
        'title',
        'seo_url',
        'short_description',
        'description',
    ];

    protected array $translatable = [
        'title',
        'short_description',
        'description',
        'seo_url',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
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
            ->generateSlugsFrom('title')
            ->saveSlugsTo('seo_url');
    }
}
