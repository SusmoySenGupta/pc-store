<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name'       => 'desktop',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tag::create([
            'name'       => 'laptop',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tag::create([
            'name'       => 'monitor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tag::create([
            'name'       => 'pc',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tag::create([
            'name'       => 'display',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
