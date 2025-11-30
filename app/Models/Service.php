<?php
// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_id';
    protected $fillable = [
        'service_name',
        'category_id'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }

    public function serviceDemands()
    {
        return $this->hasMany(ServiceDemand::class, 'service_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
