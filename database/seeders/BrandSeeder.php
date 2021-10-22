<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'Razer',
            'created_at' => now(),
            'updated_at' => now()
        ]);//1
        Brand::create([
            'name' => 'HP',
            'created_at' => now(),
            'updated_at' => now()
        ]);//2
        Brand::create([
            'name' => 'Asus',
            'created_at' => now(),
            'updated_at' => now()
        ]);//3
        Brand::create([
            'name' => 'BenQ',
            'created_at' => now(),
            'updated_at' => now()
        ]);//4
        Brand::create([
            'name' => 'Dell',
            'created_at' => now(),
            'updated_at' => now()
        ]);//5
        Brand::create([
            'name' => 'GIGABYTE',
            'created_at' => now(),
            'updated_at' => now()
        ]);//6

        Brand::create([
            'name' => 'Samsung',
            'created_at' => now(),
            'updated_at' => now()
        ]);//7
        Brand::create([
            'name' => 'Corsair',
            'created_at' => now(),
            'updated_at' => now()
        ]);//8
        Brand::create([
            'name' => 'Walton',
            'created_at' => now(),
            'updated_at' => now()
        ]);//9
        Brand::create([
            'name' => 'Acer',
            'created_at' => now(),
            'updated_at' => now()
        ]);//10
        Brand::create([
            'name' => 'AMD',
            'created_at' => now(),
            'updated_at' => now()
        ]);//11
        Brand::create([
            'name' => 'Intel',
            'created_at' => now(),
            'updated_at' => now()
        ]);//12
    }
}
