<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    
    protected $table = 'sizes';
    protected $fillable = ['menu_id', 'name', 'price'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
