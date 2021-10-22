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
            'email'             => 'susmoy.mtech@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'profile_photo'     => 'public/images/profile/fiv.jpg',
            'role'              => 'super-admin',
            'phone'             => '01748244298',
            'address'           => '259/296 Nabab Sirajdollah Road, Chittagong',
            'zip'               => 4000,
        ]);

        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'profile_photo'     => 'public/images/profile/2.jpg',
            'role'              => 'admin',
            'phone'             => '01848244298',
            'address'           => '12/4 Andorkilla, Chittagong',
            'zip'               => 4000,
        ]);

        User::create([
            'name'          => 'Customer',
            'email'         => 'customer@gmail.com',
            'password'      => bcrypt('password'),
            'profile_photo' => 'public/images/profile/3.jpg',
            'role'          => 'customer',
            'phone'         => '01648244298',
            'address'       => '26/29 Dewanbazar, Chittagong',
            'zip'           => 4000,
        ]);

        User::factory()
            ->count(50)
            ->create();
    }
}
