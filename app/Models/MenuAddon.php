<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuAddon extends Model
{
    protected $table = 'menu_addon';
    protected $fillable = ['menu_id', 'addon_id'];
}
