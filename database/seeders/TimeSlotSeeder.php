<?php
// database/seeders/TimeSlotSeeder.php
namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        $timeSlots = [
            [
                'slot_date' => Carbon::today()->addDays(1)->format('Y-m-d'),
                'start_time' => '09:00',
                'end_time' => '10:00',
                'max_capacity' => 5,
                'available_slots' => 5,
            ],
            [
                'slot_date' => Carbon::today()->addDays(1)->format('Y-m-d'),
                'start_time' => '10:00',
                'end_time' => '11:00',
                'max_capacity' => 5,
                'available_slots' => 5,
            ],
            [
                'slot_date' => Carbon::today()->addDays(2)->format('Y-m-d'),
                'start_time' => '14:00',
                'end_time' => '15:00',
                'max_capacity' => 5,
                'available_slots' => 5,
            ],
            [
                'slot_date' => Carbon::today()->addDays(2)->format('Y-m-d'),
                'start_time' => '15:00',
                'end_time' => '16:00',
                'max_capacity' => 5,
                'available_slots' => 5,
            ],
        ];

        foreach ($timeSlots as $slot) {
            TimeSlot::create($slot);
        }
    }
}
