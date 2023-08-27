<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
    use HasFactory;
    protected $fillable = ['car_id', 'maintenance_type', 'scheduled_date', 'completed'];
}
