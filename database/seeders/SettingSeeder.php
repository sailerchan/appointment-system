<?php
// database/seeders/SettingSeeder.php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'barangay_name' => 'Barangay San Isidro',
            'barangay_address' => '123 Main Street, San Isidro City',
            'barangay_agtain' => 'SANISIDRO-2024',
            'contact_number' => '(02) 8123-4567',
            'office_hour_start' => '08:00',
            'office_hours_end' => '17:00',
            'office_days' => json_encode(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'max_daily_appointments' => 20,
            'appointment_duration' => 30,
            'email_notifications' => true,
            'sms_notifications' => true,
        ]);
    }
}
