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
        'administrator_id',
        'timestop_id',
        'status_id',
        'appointment_date',
        'appointment_time',
        'duration_minutes',
        'purpose_notes',
        'reference_no'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function administrator()
    {
        return $this->belongsTo(User::class, 'administrator_id');
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'timestop_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'appointment_id');
    }
}
