<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelConsumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id', 'fuel_amount', 'distance', 'consumption', 'recorded_at'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
