<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSize extends Model
{
    
    protected $table = 'menu_sizes';
    protected $fillable = ['menu_id', 'name', 'price'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
