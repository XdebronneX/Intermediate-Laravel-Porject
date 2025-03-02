@extends('layouts.main')

@section('body')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md max-w-md">
    <h2 class="text-2xl font-bold text-[#626F47] mb-4 text-center">Select Date Range</h2>

    <form method="GET" action="{{ route('chart.date') }}">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-[#626F47]">Start Date:</label>
            <input type="date" name="start" class="w-full px-4 py-3 border rounded-lg focus:ring-[#A4B465] focus:border-[#A4B465]" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-[#626F47]">End Date:</label>
            <input type="date" name="end" class="w-full px-4 py-3 border rounded-lg focus:ring-[#A4B465] focus:border-[#A4B465]" required>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="px-6 py-2 bg-[#626F47] text-white font-semibold rounded-lg hover:bg-[#A4B465] focus:outline-none shadow-md">
                Generate Chart
            </button>
        </div>
    </form>
</div>
@endsection
