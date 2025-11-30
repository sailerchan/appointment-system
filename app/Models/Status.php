<?php
// app/Models/Status.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_id';
    protected $table = 'status'; // IMPORTANT: Specify the table name
    protected $fillable = [
        'status_name',
        'status_type',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'status_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'status_id');
    }
}
