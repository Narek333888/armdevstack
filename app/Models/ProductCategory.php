<?php

namespace App\Models;

use App\Traits\DiffForHumans;
use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes, Trashable, DiffForHumans;

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
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
