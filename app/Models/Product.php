<?php

namespace App\Models;

use App\Traits\DiffForHumans;
use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,
        SoftDeletes,
        Trashable,
        DiffForHumans;

    protected $fillable = [
        'price',
        'active',
        'show_in_home',
        'image',
        'image_original_name',
        'product_category_id',
    ];

    /**
     * @return HasOne
     */
    public function productText(): HasOne
    {
        return $this->hasOne(ProductText::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * @return Attribute
     */
    public function thumbnailImage(): Attribute
    {
        return Attribute::make(get: fn() => "storage/products/$this->image");
    }
}
