<?php

namespace App\Models;

use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ProductCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Trashable;

    protected $fillable = [
        'is_active',
        'image',
        'image_original_name',
        'deleted_at',
    ];

    /**
     * @return HasOne
     */
    public function productCategoryText(): HasOne
    {
        return $this->hasOne(ProductCategoryText::class);
    }

    /**
     * @return Attribute
     */
    protected function createdAtDiff(): Attribute
    {
        return Attribute::make(get: fn() => Carbon::parse($this->created_at)->diffForHumans());
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
