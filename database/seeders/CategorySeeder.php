<?php
// database/seeders/CategorySeeder.php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Document Services', 'description' => 'Barangay document requests'],
            ['category_name' => 'Permits', 'description' => 'Business and construction permits'],
            ['category_name' => 'Clearance', 'description' => 'Various clearance certificates'],
            ['category_name' => 'Assistance', 'description' => 'Financial and medical assistance'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
