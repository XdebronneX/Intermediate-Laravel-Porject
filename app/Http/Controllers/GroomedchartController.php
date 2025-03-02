<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chart;
use DB;
use View;
use App\Charts\Groomed;

class GroomedchartController extends Controller
{
  public function index(){
    $chartData = DB::table('grooming_info')
        ->join('groomingline', 'grooming_info.groominginfo_id', '=', 'groomingline.groominginfo_id')
        ->join('grooming_service', 'grooming_service.service_id', '=', 'groomingline.service_id')
        ->groupBy('grooming_service.service_name')
        ->pluck(DB::raw('count(grooming_service.service_name) as total'), 'grooming_service.service_name')
        ->toArray();

    $groomingChart = new Groomed;
    $groomingChart->labels(array_keys($chartData))
        ->dataset('Count of Pets Groomed', 'bar', array_values($chartData))
        ->backgroundColor('#626F47');

    $groomingChart->options([
        'responsive' => true,
        'title' => ['display' => true, 'text' => 'Grooming Count'],
        'scales' => [
            'yAxes' => [[ 'ticks' => ['beginAtZero' => true] ]],
            'xAxes' => [[ 'barPercentage' => 0.8 ]]
        ]
    ]);

    return view('charts.chartshow', compact('groomingChart'));
}

public function date(Request $request){
    $chartData = DB::table('grooming_info')
        ->join('groomingline', 'grooming_info.groominginfo_id', '=', 'groomingline.groominginfo_id')
        ->join('grooming_service', 'grooming_service.service_id', '=', 'groomingline.service_id')
        ->whereBetween('grooming_info.created_at', [$request->start, $request->end])
        ->groupBy('grooming_service.service_name')
        ->pluck(DB::raw('count(grooming_service.service_name) as total'), 'grooming_service.service_name')
        ->toArray();

    $groomingChart = new Groomed;
    $groomingChart->labels(array_keys($chartData))
        ->dataset('Count of Pets Groomed', 'bar', array_values($chartData))
        ->backgroundColor('#626F47');

    return view('charts.chartshow', compact('groomingChart'));
}


public function showdate(){
    return view('charts.datepicker');
}

}
