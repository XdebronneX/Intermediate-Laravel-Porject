@extends('layouts.main')

@section('body')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-[#626F47] mb-6 text-center">Grooming Statistics</h2>

    @if (!empty($groomingChart))
        <div class="flex justify-center">{!! $groomingChart->container() !!}</div>
        {!! $groomingChart->script() !!}
    @else
        <p class="text-center text-gray-500">No data available.</p>
    @endif

    <!-- Buttons -->
    <div class="flex justify-center space-x-4 mt-6">
        <button onclick="window.location='{{ url('/Chart/show') }}'"
            class="px-6 py-2 bg-[#626F47] text-white font-semibold rounded-lg hover:bg-[#A4B465] focus:outline-none shadow-md">
            Date Picker
        </button>
        <button onclick="window.location='{{ url('/Chart/pett') }}'"
            class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none shadow-md">
            View Pet Chart
        </button>
    </div>
</div>
@endsection
