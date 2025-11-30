<?php
// database/seeders/ResidentSeeder.php
namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        $residentUsers = User::whereHas('role', function($query) {
            $query->where('role_name', 'resident');
        })->get();

        $residents = [
            [
                'user_id' => $residentUsers[0]->user_id,
                'full_name' => 'John Doe',
                'email_address' => 'john.doe@email.com',
                'phone_number' => '09123456783',
            ],
            [
                'user_id' => $residentUsers[1]->user_id,
                'full_name' => 'Sarah Smith',
                'email_address' => 'sarah.smith@email.com',
                'phone_number' => '09123456784',
            ],
            [
                'user_id' => $residentUsers[2]->user_id,
                'full_name' => 'Michael Tan',
                'email_address' => 'michael.tan@email.com',
                'phone_number' => '09123456785',
            ],
            [
                'user_id' => $residentUsers[3]->user_id,
                'full_name' => 'Liza Gonzales',
                'email_address' => 'liza.gonzales@email.com',
                'phone_number' => '09123456786',
            ],
        ];

        foreach ($residents as $resident) {
            Resident::create($resident);
        }
    }
}
