<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clothes;
use App\Models\RentalApp;
use App\Models\RentalStat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create sample users
        $users = [
            [
                'first_name' => 'Myca',
                'last_name' => 'Lariosa',
                'user_contact_number' => '09123456789',
                'email' => 'myca@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2, // Customer role
                'user_status_id' => 1 // Active status
            ],
            [
                'first_name' => 'Bush',
                'last_name' => 'Sellote',
                'user_contact_number' => '09876543210',
                'email' => 'bush@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2, // Customer role
                'user_status_id' => 1 // Active status
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Create sample clothes
        $clothes = [
            [
                'brand' => 'Adidas',
                'category' => 'Shorts',
                'size' => 'M',
                'price' => 800.00,
                'color' => 'Blue',
                'material' => 'Cotton',
                'description' => 'A comfortable blue cotton shorts.'
            ],
            [
                'brand' => 'Nike',
                'category' => 'T-Shirt',
                'size' => 'L',
                'price' => 1200.00,
                'color' => 'Black',
                'material' => 'Polyester',
                'description' => 'Classic black Nike t-shirt.'
            ],
            [
                'brand' => 'Puma',
                'category' => 'Jacket',
                'size' => 'XL',
                'price' => 2500.00,
                'color' => 'Red',
                'material' => 'Nylon',
                'description' => 'Sporty red jacket for outdoor activities.'
            ]
        ];

        foreach ($clothes as $clothing) {
            Clothes::create($clothing);
        }

        // Create sample rentals
        $rentals = [
            [
                'user_id' => 2, // Myca Lariosa's ID
                'clothes_id' => 1, // Adidas Shorts
                'rental_date' => '2024-03-20',
                'return_date' => '2024-03-25',
                'payment_method' => 'Credit Card',
                'total_payment' => 800.00,
                'rental_status_id' => 1 // pending
            ],
            [
                'user_id' => 3, // Bush Sellote's ID
                'clothes_id' => 2, // Nike T-Shirt
                'rental_date' => '2024-03-21',
                'return_date' => '2024-03-26',
                'payment_method' => 'Cash',
                'total_payment' => 1200.00,
                'rental_status_id' => 2 // rented
            ]
        ];

        foreach ($rentals as $rental) {
            RentalApp::create($rental);
        }
    }
}
