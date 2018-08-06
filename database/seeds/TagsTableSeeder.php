<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tag::create([
            'name' => 'Oración',
            'slug' => 'oración',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        App\Tag::create([
            'name' => 'Amor',
            'slug' => 'amor',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        App\Tag::create([
            'name' => 'Adoración',
            'slug' => 'adoración',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
