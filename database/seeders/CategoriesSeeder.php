<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Platter',
            'Wings',
            'Burger',
            'Pasta',
            'Sandwich',
            'Rolls',
            'Nuggets & Shots',
            'Fries',
            'Drinks',
            'Pizza',
            'Deals'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'title' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
