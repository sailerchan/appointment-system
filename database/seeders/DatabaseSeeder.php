<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
   {
    $this->call([
        StatusSeeder::class,    // #1 - Creates statuses for users & appointments
        RoleSeeder::class,      // #2 - Creates admin, staff, resident roles
        PositionSeeder::class,  // #3 - Creates barangay positions
        CategorySeeder::class,  // #4 - Creates service categories
        ServiceSeeder::class,   // #5 - Creates services (needs categories)
        SettingSeeder::class,   // #6 - Creates barangay settings
        UserSeeder::class,      // #7 - Creates users (needs roles, positions, status)
        ResidentSeeder::class,  // #8 - Creates residents (needs users)
        TimeSlotSeeder::class,  // #9 - Creates time slots for appointments
    ]);
}
}
