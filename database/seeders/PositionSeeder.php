<?php
// database/seeders/PositionSeeder.php
namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            ['position_name' => 'Secretary', 'description' => 'Barangay Secretary'],
            ['position_name' => 'Captain', 'description' => 'Barangay Captain'],
            ['position_name' => 'Clerk', 'description' => 'Administrative Clerk'],
            ['position_name' => 'Treasurer', 'description' => 'Barangay Treasurer'],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
