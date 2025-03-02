<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chart;
use DB;
use View;
use App\Charts\Diseases;

class DiseaseschartController extends Controller
{
   public function index(){
    $chartData = DB::table('health_consultation')
        ->join('consultation_disease', 'health_consultation.consult_id', '=', 'consultation_disease.consult_id')
        ->join('disease_injuries', 'consultation_disease.disease_id', '=', 'disease_injuries.disease_id')
        ->groupBy('disease_injuries.disease_name')
        ->pluck(DB::raw('count(disease_injuries.disease_name) as total'), 'disease_injuries.disease_name')
        ->toArray();

    $petChart = new Diseases;
    $petChart->labels(array_keys($chartData))
        ->dataset('Count of Diseases', 'bar', array_values($chartData))
        ->backgroundColor('#900020');

    $petChart->options([
        'responsive' => true,
        'title' => ['display' => true, 'text' => 'Disease Count'],
        'scales' => [
            'yAxes' => [[ 'ticks' => ['beginAtZero' => true] ]],
            'xAxes' => [[ 'barPercentage' => 0.8 ]]
        ]
    ]);

    return view('charts.chartpet', compact('petChart'));
}

}
