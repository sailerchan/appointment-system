<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            StatusSeeder::class,
            PositionSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            UserSeeder::class,
            ResidentSeeder::class,
            TimeSlotSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
