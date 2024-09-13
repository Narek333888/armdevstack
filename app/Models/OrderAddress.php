<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'city',
        'address1',
        'address2',
        'order_id',
        'first_name',
        'last_name',
        'state',
        'zip_code',
        'phone',
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return  $this->belongsTo(Order::class);
    }
}
