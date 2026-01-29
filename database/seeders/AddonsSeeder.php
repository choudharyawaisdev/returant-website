<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddonsSeeder extends Seeder
{
    public function run()
    {
        $addons = [
            ['name' => 'Extra Cheese', 'price' => 50],
            ['name' => 'Mayo Sauce', 'price' => 20],
            ['name' => 'BBQ Sauce', 'price' => 30],
            ['name' => 'Hot Sauce', 'price' => 25],
            ['name' => 'Ketchup', 'price' => 15],
            ['name' => 'Mustard', 'price' => 15],
            ['name' => 'Garlic Dip', 'price' => 20],
            ['name' => 'Ranch Dressing', 'price' => 25],
            ['name' => 'Jalapenos', 'price' => 30],
            ['name' => 'Olives', 'price' => 35],
        ];

        foreach ($addons as $addon) {
            DB::table('addons')->insert([
                'name' => $addon['name'],
                'price' => $addon['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
