@extends('layouts.main')

@section('body')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-[#626F47] mb-6 text-center">Disease Statistics</h2>

    @if (!empty($petChart))
        <div class="flex justify-center">{!! $petChart->container() !!}</div>
        {!! $petChart->script() !!}
    @else
        <p class="text-center text-gray-500">No data available.</p>
    @endif
</div>
@endsection
