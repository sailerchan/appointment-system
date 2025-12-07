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
        // Get IDs from previously seeded data - USE EXACT NAMES
        $adminRole = Role::where('role_name', 'Administrator')->first();
        $residentRole = Role::where('role_name', 'Resident')->first();

        // Filter by 'user' status_type - CRITICAL!
        $activeStatus = Status::where('status_name', 'Active')
                              ->where('status_type', 'user')
                              ->first();

        // Use EXACT position names
        $secretaryPosition = Position::where('position_name', 'Barangay Secretary')->first();
        $captainPosition = Position::where('position_name', 'Barangay Captain')->first();
        $clerkPosition = Position::where('position_name', 'Clerk')->first();
        $treasurerPosition = Position::where('position_name', 'Barangay Treasurer')->first();

        // Provide fallback IDs if lookups fail
        $users = [
            // Admin users - MUST have position_id
            [
                'email' => 'admin@barangay.com',
                'password_hash' => Hash::make('admin123'),
                'full_name' => 'Barangay Administrator',
                'phone_number' => '09123456789',
                'role_id' => $adminRole ? $adminRole->role_id : 1,
                'position_id' => $captainPosition ? $captainPosition->position_id : 1,
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now(),
            ],
            [
                'email' => 'secretary@barangay.com',
                'password_hash' => Hash::make('secretary123'),
                'full_name' => 'Maria Santos',
                'phone_number' => '09123456780',
                'role_id' => $adminRole ? $adminRole->role_id : 1,
                'position_id' => $secretaryPosition ? $secretaryPosition->position_id : 2,
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now()->subDays(1),
            ],
            [
                'email' => 'clerk@barangay.com',
                'password_hash' => Hash::make('clerk123'),
                'full_name' => 'Juan Dela Cruz',
                'phone_number' => '09123456781',
                'role_id' => $adminRole ? $adminRole->role_id : 1,
                'position_id' => $clerkPosition ? $clerkPosition->position_id : 3,
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now()->subDays(2),
            ],
            [
                'email' => 'treasurer@barangay.com',
                'password_hash' => Hash::make('treasurer123'),
                'full_name' => 'Ana Reyes',
                'phone_number' => '09123456782',
                'role_id' => $adminRole ? $adminRole->role_id : 1,
                'position_id' => $treasurerPosition ? $treasurerPosition->position_id : 4,
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now()->subDays(3),
            ],

            // Resident users - GIVE THEM A POSITION (can't be null)
            [
                'email' => 'john.doe1@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'John Doe',
                'phone_number' => '09123456783',
                'role_id' => $residentRole ? $residentRole->role_id : 5,
                'position_id' => $clerkPosition ? $clerkPosition->position_id : 3, // Give them a position
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now()->subDays(4),
            ],
            [
                'email' => 'sarah.smith1@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'Sarah Smith',
                'phone_number' => '09123456784',
                'role_id' => $residentRole ? $residentRole->role_id : 5,
                'position_id' => $clerkPosition ? $clerkPosition->position_id : 3, // Give them a position
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now()->subDays(5),
            ],
            [
                'email' => 'michael.tan@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'Michael Tan',
                'phone_number' => '09123456785',
                'role_id' => $residentRole ? $residentRole->role_id : 5,
                'position_id' => $clerkPosition ? $clerkPosition->position_id : 3, // Give them a position
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now()->subDays(6),
            ],
            [
                'email' => 'liza.gonzales@email.com',
                'password_hash' => Hash::make('resident123'),
                'full_name' => 'Liza Gonzales',
                'phone_number' => '09123456786',
                'role_id' => $residentRole ? $residentRole->role_id : 5,
                'position_id' => $clerkPosition ? $clerkPosition->position_id : 3, // Give them a position
                'status_id' => $activeStatus ? $activeStatus->status_id : 1,
                'last_login_at' => now()->subDays(7),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

