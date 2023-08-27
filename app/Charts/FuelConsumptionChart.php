<?php

namespace App\Charts;

use App\Models\FuelConsumption;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class FuelConsumptionChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($data): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $fuel = [];
        $date = [];
        foreach ($data as $datas) {
            $fuel[] = $datas->consumption;
            $date[] = date('d M Y', strtotime($datas->recorded_at));
        }
        return $this->chart->lineChart()
            ->setTitle('Fuel Consumption')
            ->addData('Km/L', $fuel)
            ->setXAxis($date);
    }
}
