<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the user by email (assuming there's only one admin user)
        $user = User::where('email', 'admin@test.com')->first();

        // Check if the user was found to avoid potential errors
        if ($user) {
            $vendor = new Vendor();
            $vendor->banner = 'uploads/123455.jpg'; // Path to the banner image
            $vendor->phone = '122344567'; // Vendor phone number
            $vendor->email = 'admin@test.com'; // Vendor email
            $vendor->address = 'UK'; // Vendor address
            $vendor->description = 'shop description'; // Description of the shop
            $vendor->user_id = $user->id; // Associate vendor with the user found above
            $vendor->save(); // Save the vendor record to the database
        } else {
            // Optionally, you can log a message or handle the case when the user is not found
            \Log::warning('Admin user not found. Vendor not created.');
        }
    }
}
