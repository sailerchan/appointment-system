<?php
// app/Models/Notification.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'notification_id';
    protected $fillable = [
        'resident_id',
        'appointment_id',
        'message',
        'sent_at',
        'is_read'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
