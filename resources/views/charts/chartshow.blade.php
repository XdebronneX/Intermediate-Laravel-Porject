@extends('layouts.main')
@section('body')
    <div class="container">
        <center>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h1>Groom Count </h1>
                    @if (empty($groomingChart))
                        <div></div>
                    @else
                        <div>{!! $groomingChart->container() !!}</div>
                        {!! $groomingChart->script() !!}
                    @endif
                </div>
                <button type="button" onclick="window.location='{{ url('/Chart/show') }}'">Date Picker</button>
                <button type="button" onclick="window.location='{{ url('/Chart/pett') }}'">Chart</button>
            </div>
        </center>
    </div>
@endsection
