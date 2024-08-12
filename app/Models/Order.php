<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_quantity',
        'order_id',
        'coupon_price',
        'delivery_charge',
        'grand_total',
        'order_approval_date',
        'order_completed_date',
        'order_declined_date',
        'order_status',
        'order_delivered_date',
        'payment_approval_date',
        'payment_method',
        'payment_status',
        'sub_total',
        'transaction_id',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return HasOne
     */
    public function orderAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class);
    }
}
