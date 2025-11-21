<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $table = 'addons';
   
     protected $fillable = [
        'menu_id',
        'name',
        'price',
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_addon', 'addon_id', 'menu_id');
    }


}
