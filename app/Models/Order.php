<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Додайте 'user_id' якщо будете прив'язувати до юзера
        'status',
        'total',
    ];

    /**
     * Отримати всі елементи (квитки) цього замовлення.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
