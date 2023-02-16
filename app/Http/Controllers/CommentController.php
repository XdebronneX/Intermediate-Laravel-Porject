<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroomingService;
use View;
use DB;
use Redirect;
use Auth;

class CommentController extends Controller
{
    public function index(){
        $transacts = GroomingService::all();

        return View::make('comment.comments',compact('transacts'));
    }

    public function comment($id){
        // dd($id);
        $serv = GroomingService::where('grooming_service.service_id', $id)->first();
        $service = GroomingService::join('comment_reviews', 'comment_reviews.service_id', 'grooming_service.service_id')
        ->select('*')
        ->where('grooming_service.service_id', $id)->get();

        $comid = $id;

        return View::make('comment.createcom',compact('service','comid','serv'));
    }

    public function req(Request $request){
        // dd($request->all());
        $string = app('profanityFilter')->filter($request->comment);
        DB::table('comment_reviews')->insert(
            ['name' => Auth()->user()->name,
             'service_id' => $request->comid,
             'comment' => $string,
           ]
        );
        return redirect()->back();
    }
}
