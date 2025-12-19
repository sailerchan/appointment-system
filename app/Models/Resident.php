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
        'full_name',
        'email_address',
        'phone_number'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'resident_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'resident_id');
    }
}
