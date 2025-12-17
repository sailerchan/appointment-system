<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'email',
        'password_hash',
        'full_name',
        'phone_number',
        'role_id',
        'position_id',
        'status_id',
        'last_login_at'
    ];

    protected $hidden = ['password_hash'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function administratorAppointments()
    {
        return $this->hasMany(Appointment::class, 'administrator_id');
    }
}
