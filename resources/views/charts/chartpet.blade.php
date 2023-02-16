@extends('layouts.main')
@section('body')
    <div class="container">
        <center>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h1>Disease Count </h1>
                    @if (empty($petChart))
                        <div></div>
                    @else
                        <div>{!! $petChart->container() !!}</div>
                        {!! $petChart->script() !!}
                    @endif
                </div>
            </div>
        </center>
    </div>
@endsection
