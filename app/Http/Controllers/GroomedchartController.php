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

    $chartt = DB::table('grooming_info')
    ->join('groomingline','grooming_info.groominginfo_id','groomingline.groominginfo_id')
    ->join('grooming_service','grooming_service.service_id','groomingline.service_id')
    ->groupBy('grooming_service.service_name')
    ->pluck(DB::raw('count(grooming_service.service_name) as total'),'grooming_service.service_name')
    ->toArray();

$groomingChart = new Groomed;

$dataset = $groomingChart->labels(array_keys($chartt));

$dataset = $groomingChart->dataset('Count of Pets Groomed', 'bar', array_values($chartt));
$dataset = $dataset->backgroundColor(collect(['#900020']));
$groomingChart->options([
    'responsive' => true,
    
    'tooltips' => ['enabled'=> true],

    'title' => [
        'display'=> true,
        'text' => ''
      ],

    'aspectRatio' => 1,
    'scales' => [
        'yAxes'=> [[
                    'display'=>true,
                    'ticks'=> ['beginAtZero'=> true],
                    'gridLines'=> ['display'=> true],
                  ]],
            'xAxes'=> [[
                    'categoryPercentage'=> 0.8,
                    //'barThickness' => 100,
                    'barPercentage' => 1,
                    'ticks' => ['beginAtZero' => false],
                    'gridLines' => ['display' => true],
                    'display' => true

                  ]],
    ],
  '{outlabels: {display: true}}',
]);

return view('charts.chartshow', compact('groomingChart') );
 }

 public function date(Request $request){

    // dd($request->all());

    $chartt = DB::table('grooming_info')
    ->join('groomingline','grooming_info.groominginfo_id','groomingline.groominginfo_id')
    ->join('grooming_service','grooming_service.service_id','groomingline.service_id')
    ->groupBy('grooming_service.service_name')
    ->whereBetween('grooming_info.created_at',[$request->start, $request->end])
    ->pluck(DB::raw('count(grooming_service.service_name) as total'),'grooming_service.service_name')
    ->toArray();

$groomingChart = new Groomed;

$dataset = $groomingChart->labels(array_keys($chartt));

$dataset = $groomingChart->dataset('Count of Pets Groomed', 'bar', array_values($chartt));
$dataset = $dataset->backgroundColor(collect(['#900020']));
$groomingChart->options([
    'responsive' => true,

    'tooltips' => ['enabled'=> true],

    'title' => [
        'display'=> true,
        'text' => ''
      ],

    'aspectRatio' => 1,
    'scales' => [
        'yAxes'=> [[
                    'display'=>true,
                    'ticks'=> ['beginAtZero'=> true],
                    'gridLines'=> ['display'=> true],
                  ]],
            'xAxes'=> [[
                    'categoryPercentage'=> 0.8,
                    //'barThickness' => 100,
                    'barPercentage' => 1,
                    'ticks' => ['beginAtZero' => false],
                    'gridLines' => ['display' => true],
                    'display' => true

                  ]],
    ],
  '{outlabels: {display: true}}',
]);



return view('charts.chartshow', compact('groomingChart') );
 }

public function showdate(){
    return view('charts.datepicker');
}

}
