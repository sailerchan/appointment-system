<?php
// app/Models/Position.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $primaryKey = 'position_id';
    protected $fillable = [
        'position_name',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'position_id');
    }
}
