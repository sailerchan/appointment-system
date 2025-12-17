<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StatusSeeder::class,    // #1 - Independent
            RoleSeeder::class,      // #2 - Independent
            PositionSeeder::class,  // #3 - Independent
            CategorySeeder::class,  // #4 - Independent
            ServiceSeeder::class,   // #5 - Needs categories
            SettingSeeder::class,   // #6 - Independent
            // UserSeeder AFTER RoleSeeder & PositionSeeder
            UserSeeder::class,      // #7 - Needs roles & positions
            // ResidentSeeder AFTER UserSeeder (and BEFORE TimeSlotSeeder)
            ResidentSeeder::class,  // #8 - Needs users
            TimeSlotSeeder::class,  // #9 - Independent
        ]);
    }
}
