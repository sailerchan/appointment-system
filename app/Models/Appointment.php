<?php
// app/Models/Appointment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\TimeSlot;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'resident_id',
        'service_id',
        'timeslot_id',
        'status_id',
        'purpose_notes',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            do {
                $reference = 'REF-' . strtoupper(Str::random(8));
            } while (self::where('reference_no', $reference)->exists()); // Check for collision

            $model->reference_no = $reference;

            $pendingStatus = Status::where('status_name', 'Pending')->first();
            $model->status()->associate($pendingStatus);

            $timeslot = TimeSlot::lockForUpdate()->find($model->timeslot_id);

            if (!$timeslot || $timeslot->available_slots <= 0) {
                throw new \Exception('Selected timeslot is fully booked.');
            }

            $timeslot->decrement('available_slots');
        });
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    public function timeSlot()
    {

       return $this->belongsTo(TimeSlot::class, 'timeslot_id', 'timeslot_id');
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
