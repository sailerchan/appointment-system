<?php
// app/Models/Report.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $primaryKey = 'report_id';
    protected $fillable = [
        'total_appointments',
        'no_show_rate',
        'average_processing_time',
        'generated_at'
    ];
}
