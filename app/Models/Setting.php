<?php
// app/Models/Setting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $primaryKey = 'settings_id';
    protected $fillable = [
        'barangay_name',
        'barangay_address',
        'barangay_agtain',
        'contact_number',
        'office_hour_start',
        'office_hours_end',
        'office_days',
        'max_daily_appointments',
        'appointment_duration',
        'email_notifications',
        'sms_notifications'
    ];

    protected $casts = [
        'office_days' => 'array',
        'email_notifications' => 'boolean',
        'sms_notifications' => 'boolean'
    ];
}
