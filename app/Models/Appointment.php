<?php
// app/Models/Appointment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'resident_id',
        'service_id',
        'role_id',          // ← CHANGE THIS LINE
        'timeslot_id',      // ← CHANGE THIS LINE
        'status_id',
        'appointment_date',
        'appointment_time',
        'duration_minutes',
        'purpose_notes',
        'reference_no'
    ];

    public function resident()
    {

        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function service()
    {
        // Specify custom foreign key since services table uses service_id
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    public function role()  // CHANGED: administrator() → role()
    {
        // Links to roles.role_id (not users.user_id)
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function timeSlot()  // Already correct name
    {

       return $this->belongsTo(TimeSlot::class, 'timeslot_id', 'timestop_id');
    }

    public function status()
    {
        // Specify custom foreign key since status table uses status_id
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'appointment_id', 'appointment_id');
    }
}
