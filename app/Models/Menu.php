<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'price',
        'discount',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
