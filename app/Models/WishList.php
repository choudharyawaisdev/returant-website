<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wish_lists'; // make sure this matches your DB table
    protected $fillable = ['user_id', 'menu_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
