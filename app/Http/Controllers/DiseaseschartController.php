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

        $chartt = DB::table('health_consultation')
        ->join('consultation_disease','health_consultation.consult_id','consultation_disease.consultation_consult_id')
        ->join('disease_injuries','consultation_disease.disease_disease_id','disease_injuries.disease_id')
        ->groupBy('disease_injuries.disease_name')
        ->pluck(DB::raw('count(disease_injuries.disease_name) as total'),'disease_injuries.disease_name')
        ->toArray();

    $petChart = new Diseases;

    $dataset = $petChart->labels(array_keys($chartt));

    $dataset = $petChart->dataset('Count of Diseases', 'bar', array_values($chartt));
    $dataset = $dataset->backgroundColor(collect(['#900020']));
    $petChart->options([
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

    return view('charts.chartpet', compact('petChart') );
     }
}
