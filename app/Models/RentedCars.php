<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RentedCars extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_id', 'rental_date', 'return_date', 'condition_at_return'
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function scopeLatestReturnDate($query, $carId)
    {
        return $query->where('car_id', $carId)
            ->orderBy('return_date', 'desc')
            ->value('return_date');
    }

    public static function getMaxReturnDates()
    {
        return static::select('car_id', DB::raw('MAX(return_date) as max_return_date'))
            ->groupBy('car_id')
            ->get();
    }
}
