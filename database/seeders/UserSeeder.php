<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'Super Admin',
            'email'             => 'sadmin@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'role'              => 'super-admin',
        ]);

        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'role'              => 'admin',
        ]);

        User::create([
            'name'     => 'Customer',
            'email'    => 'customer@gmail.com',
            'password' => bcrypt('password'),
            'role'     => 'customer',
        ]);
    }
}
