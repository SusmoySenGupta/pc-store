<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Parents
        Category::create([
            'name' => 'Desktop',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]); //1
        Category::create([
            'name' => 'Laptop',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//2
        Category::create([
            'name' => 'Component',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//3
        Category::create([
            'name' => 'Monitor',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//4
        Category::create([
            'name' => 'UPS',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//5
        Category::create([
            'name' => 'Tablet',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//6
        Category::create([
            'name' => 'Office Equipment',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//7
        Category::create([
            'name' => 'Camera',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//8
        Category::create([
            'name' => 'Security',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//9
        Category::create([
            'name' => 'Networking',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//10
        Category::create([
            'name' => 'Accessories',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//11
        Category::create([
            'name' => 'Software',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//12
        Category::create([
            'name' => 'Server-Storage',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//13
        Category::create([
            'name' => 'TV',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//14
        Category::create([
            'name' => 'AC',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//15
        Category::create([
            'name' => 'Gadget',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//16
        Category::create([
            'name' => 'Gaming',
            'parent_id' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//17

        Category::create([
            'name' => 'Special Pc',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//18
        Category::create([
            'name' => 'Start Pc',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//19
        Category::create([
            'name' => 'Ryzen Pc',
            'parent_id' => 19,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//20
        Category::create([
            'name' => 'Intel Pc',
            'parent_id' => 19,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//21

        Category::create([
            'name' => 'Gaming laptop',
            'parent_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//22
        Category::create([
            'name' => 'Razer',
            'parent_id' => 22,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//23
        Category::create([
            'name' => 'HP',
            'parent_id' => 22,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//24
        Category::create([
            'name' => 'ASUS',
            'parent_id' => 22,
            'created_at' => now(),
            'updated_at' => now(),
        ]);//25
    }
}
