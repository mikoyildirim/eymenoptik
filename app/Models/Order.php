<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_number', 'full_name', 'phone', 'email', 'address', 'total_price', 'status', 'iyzico_paid', 'iyzico_payment_id'];

    protected $casts = [
        'iyzico_paid' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopePaid($query)
    {
        return $query->where('iyzico_paid', true);
    }
}
