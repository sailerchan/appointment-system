<?php
// database/seeders/UserSeeder.php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Position;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Get IDs from previously seeded data
        $adminRole = Role::where('role_name', 'admin staff')->first();
        $residentRole = Role::where('role_name', 'resident')->first();
        $activeStatus = Status::where('status_name', 'Active')->first();
        $secretaryPosition = Position::where('position_name', 'Secretary')->first();
        $captainPosition = Position::where('position_name', 'Captain')->first();
        $clerkPosition = Position::where('position_name', 'Clerk')->first();
        $treasurerPosition = Position::where('position_name', 'Treasurer')->first();

        $users = [
            // Admin users
            [
                'email' => 'admin@barangay.com',
                'password_hash' => Hash::make('admin123'),
                'full_name' => 'Barangay Administrator',
                'phone_number' => '09123456789',
                'role_id' => $adminRole->role_id,
                'position_id' => $captainPosition->position_id,
                'status_id' => $activeStatus->status_id,
            ],
            [
                'email' => 'secretary@barangay.com',
                'password_hash' => Hash::make('secretary123'),
                'full_name' => 'Maria Santos',
                'phone_number' => '09123456780',
                'role_id' => $adminRole->role_id,
                'position_id' => $secretaryPosition->position_id,
                'status_id' => $activeStatus->status_id,
            ],
            [
                'email' => 'clerk@barangay.com',
                'password_hash' => Hash::make('clerk123'),
                'full_name' => 'Juan Dela Cruz',
                'phone_number' => '09123456781',
                'role_id' => $adminRole->role_id,
                'position_id' => $clerkPosition->position_id,
                'status_id' => $activeStatus->status_id,
            ],
            [
                'email' => 'treasurer@barangay.com',
                'password_hash' => Hash::make('treasurer123'),
                'full_name' => 'Ana Reyes',
                'phone_number' => '09123456782',
                'role_id' => $adminRole->role_id,
                'position_id' => $treasurerPosition->position_id,
                'status_id' => $activeStatus->status_id,
            ],

            // Resident users
            [
                'email' => 'john.doe@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'John Doe',
                'phone_number' => '09123456783',
                'role_id' => $residentRole->role_id,
                'position_id' => null,
                'status_id' => $activeStatus->status_id,
            ],
            [
                'email' => 'sarah.smith@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'Sarah Smith',
                'phone_number' => '09123456784',
                'role_id' => $residentRole->role_id,
                'position_id' => null,
                'status_id' => $activeStatus->status_id,
            ],
            [
                'email' => 'michael.tan@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'Michael Tan',
                'phone_number' => '09123456785',
                'role_id' => $residentRole->role_id,
                'position_id' => null,
                'status_id' => $activeStatus->status_id,
            ],
            [
                'email' => 'liza.gonzales@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'Liza Gonzales',
                'phone_number' => '09123456786',
                'role_id' => $residentRole->role_id,
                'position_id' => null,
                'status_id' => $activeStatus->status_id,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
