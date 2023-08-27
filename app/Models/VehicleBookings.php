<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VehicleBookings extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'car_id', 'booking_date', 'pickup_date', 'return_date', 'purpose', 'approved', 'authorized'];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function scopeLatestReturnDate($query, $carId)
    {
        return $query->where('car_id', $carId)
            ->where('approved', 1)
            ->where('authorized', 1)
            ->orderBy('return_date', 'desc')
            ->value('return_date');
    }

    public static function getMaxReturnDates()
    {
        return static::select('car_id', DB::raw('MAX(return_date) as max_return_date'))
            ->groupBy('car_id')
            ->where('approved', 1)
            ->where('authorized', 1)
            ->get();
    }
}
