<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ProductCategoryText extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatableSlug;

    protected $fillable = [
        'name',
        'description',
        'meta_description',
        'meta_keywords',
        'meta_title',
        'seo_url',
        'product_category_id',
        'language_id',
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
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
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
