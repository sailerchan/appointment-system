<?php

namespace Database\Seeders;

use App\Models\Resident;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $residents = [
            [
                'full_name' => 'John Doe',
                'email_address' => 'john.doe@email.com',
                'phone_number' => '09123456783',
            ],
            [
                'full_name' => 'Sarah Smith',
                'email_address' => 'sarah.smith@email.com',
                'phone_number' => '09123456784',
            ],
            [
                'full_name' => 'Michael Tan',
                'email_address' => 'michael.tan@email.com',
                'phone_number' => '09123456785',
            ],
            [
                'full_name' => 'Liza Gonzales',
                'email_address' => 'liza.gonzales@email.com',
                'phone_number' => '09123456786',
            ],
        ];

        foreach ($residents as $resident) {
            Resident::firstOrCreate(
                ['email_address' => $resident['email_address']],
                $resident
            );
        }

        echo "Residents seeded successfully.\n";
    }
}
