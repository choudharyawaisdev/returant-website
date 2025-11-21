<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'title',
        'quantity',
        'unit_price',
        'total_price',
        'size_name',
        'add_ons_details',
    ];

    protected $casts = [
        'add_ons_details' => 'json',
    ];

    /**
     * Define relationship with the parent order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    // You might also define a relationship to the Menu/Product model here
}