<?php
// app/Models/Resident.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $primaryKey = 'resident_id';
    protected $fillable = [
        'user_id',
        'full_name',
        'email_address',
        'phone_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'resident_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'resident_id');
    }
}

