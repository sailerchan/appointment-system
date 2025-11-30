<?php
// app/Models/ServiceDemand.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDemand extends Model
{
    use HasFactory;

    protected $primaryKey = 'demand_id';
    protected $fillable = [
        'service_id',
        'request_count',
        'percentage',
        'ranking'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
