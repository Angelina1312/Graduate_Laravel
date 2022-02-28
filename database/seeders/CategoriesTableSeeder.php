<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Мантии выпускников', 'code' => 'graduate', 'description' => 'В этом разделе, вы найдете различные мантии для выпускников', 'images' => 'categories/masterskit.jpg'],
            ['name' => 'Детские мантии', 'code' => 'child', 'description' => 'В этом разделе, вы найдете различные детские мантии', 'images' => 'categories/childgownblack.jpg'],
            ['name' => 'Академические шапочки', 'code' => 'hats', 'description' => 'В этом разделе, вы найдете различные академические шапочки', 'images' => 'categories/academshapallcol.jpg'],
            ['name' => 'Галстуки', 'code' => 'ties', 'description' => 'В этом разделе, вы найдете различные галстуки выпускников', 'images' => 'categories/tie.jpg'],
        ]);
    }
}
