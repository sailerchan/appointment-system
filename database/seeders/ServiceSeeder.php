<?php
// database/seeders/ServiceSeeder.php
namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $documentCategory = Category::where('category_name', 'Document Services')->first();
        $permitCategory = Category::where('category_name', 'Permits')->first();
        $clearanceCategory = Category::where('category_name', 'Clearance')->first();
        $assistanceCategory = Category::where('category_name', 'Assistance')->first();

        $services = [
            // Document Services
            ['service_name' => 'Barangay ID', 'category_id' => $documentCategory->category_id],
            ['service_name' => 'Certificate of Indigency', 'category_id' => $documentCategory->category_id],
            ['service_name' => 'Certificate of Residency', 'category_id' => $documentCategory->category_id],

            // Permits
            ['service_name' => 'Business Permit', 'category_id' => $permitCategory->category_id],
            ['service_name' => 'Mayor\'s Permit', 'category_id' => $permitCategory->category_id],
            ['service_name' => 'Construction Permit', 'category_id' => $permitCategory->category_id],

            // Clearance
            ['service_name' => 'Barangay Clearance', 'category_id' => $clearanceCategory->category_id],
            ['service_name' => 'Police Clearance', 'category_id' => $clearanceCategory->category_id],
            ['service_name' => 'NBI Clearance', 'category_id' => $clearanceCategory->category_id],

            // Assistance
            ['service_name' => 'Medical Assistance', 'category_id' => $assistanceCategory->category_id],
            ['service_name' => 'Financial Assistance', 'category_id' => $assistanceCategory->category_id],
            ['service_name' => 'Burial Assistance', 'category_id' => $assistanceCategory->category_id],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
