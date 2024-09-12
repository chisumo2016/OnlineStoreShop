<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            /*Admin Data*/
            [
                'name' => 'Admin user',
                'username' => 'adminuser',
                'email' => 'admin@test.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password'),
            ],

            /*Vendor Data*/
            [
                'name' => 'Vendor user',
                'username' => 'vendoruser',
                'email' => 'vendor@test.com',
                'role' => 'vendor',
                'status' => 'active',
                'password' => bcrypt('password'),
            ],

            /*User Data*/
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@test.com',
                'role' => 'user',
                'status' => 'active',
                'password' => bcrypt('password'),
            ],
        ]);
    }
}
