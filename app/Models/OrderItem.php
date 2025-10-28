<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'post_id',
        'name',
        'quantity',
        'price',
    ];

    /**
     * Отримати замовлення, до якого належить цей елемент.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Отримати пост (туристичне місце), до якого належить цей елемент.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
