<?php
// database/seeders/RoleSeeder.php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['role_name' => 'admin staff', 'description' => 'Administrative staff'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
