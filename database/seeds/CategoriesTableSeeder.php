<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create([
            'name' => 'Familia',
            'slug' =>  'familia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        App\Category::create([
            'name' => 'Fé',
            'slug' =>  'fé',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        App\Category::create([
            'name' => 'Ministerios',
            'slug' =>  'ministerios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
