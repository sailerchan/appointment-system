<?php
// database/seeders/StatusSeeder.php
namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            // Appointment statuses
            ['status_name' => 'Pending', 'status_type' => 'appointment', 'description' => 'Waiting for confirmation'],
            ['status_name' => 'Confirmed', 'status_type' => 'appointment', 'description' => 'Appointment confirmed'],
            ['status_name' => 'Completed', 'status_type' => 'appointment', 'description' => 'Appointment completed'],
            ['status_name' => 'Cancelled', 'status_type' => 'appointment', 'description' => 'Appointment cancelled'],
            ['status_name' => 'No-show', 'status_type' => 'appointment', 'description' => 'Client did not show up'],

            // User statuses
            ['status_name' => 'Active', 'status_type' => 'user', 'description' => 'User is active'],
            ['status_name' => 'Inactive', 'status_type' => 'user', 'description' => 'User is inactive'],
            ['status_name' => 'Suspended', 'status_type' => 'user', 'description' => 'User is suspended'],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
