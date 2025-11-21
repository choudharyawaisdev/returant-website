<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'mobile_number',
        'email',
        'delivery_address',
        'special_instructions',
        'subtotal',
        'delivery_fee',
        'total_amount',
        'payment_method',
        'status',
    ];

    /**
     * Define relationship with order items.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    /**
     * Define relationship with the user who placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}