<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
            'name' =>'SuperAdmin',
            'email' => 'sadmin@gmail.com',
            'password' => Hash::make('secret')
            ]);

        DB::table('users')->insert(
        [
        'name' =>'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('secret')
        ]);

        DB::table('users')->insert(
        [
        'name' =>'User',
        'email' => 'user@gmail.com',
        'password' => Hash::make('secret')
        ]);
    }
}
