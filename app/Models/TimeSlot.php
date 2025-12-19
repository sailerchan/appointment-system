<?php
// app/Models/TimeSlot.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $primaryKey = 'timeslot_id';
    protected $fillable = [
        'slot_date',
        'start_time',
        'end_time',
        'max_capacity',
        'available_slots'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'timeslot_id');
    }
}
