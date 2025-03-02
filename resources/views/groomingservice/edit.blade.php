@extends('layouts.main')

@section('content')
<div class="container mx-auto p-8 bg-gray-50 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-[#626F47] mb-6">Edit Grooming Service</h2>

    {{ Form::model($groomingservice, ['route' => ['grooming.update', $groomingservice->service_id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @php
            $inputStyles = "mt-1 block w-full px-4 py-3 border-2 border-[#626F47] bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] placeholder-gray-500";
        @endphp

        <!-- Service Name -->
        <div>
            <label for="service_name" class="block text-sm font-semibold text-[#626F47]">Service Name:</label>
            {{ Form::text('service_name', null, ['class' => $inputStyles, 'placeholder' => 'Enter Service Name']) }}
            @error('service_name') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Service Cost -->
        <div>
            <label for="service_cost" class="block text-sm font-semibold text-[#626F47]">Service Cost:</label>
            {{ Form::text('service_cost', null, ['class' => $inputStyles, 'placeholder' => 'Enter Service Cost']) }}
            @error('service_cost') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Image Upload -->
        <div class="col-span-2">
            <label for="image" class="block text-sm font-semibold text-[#626F47]">Service Image:</label>
            <input type="file" class="{{ $inputStyles }}" id="image" name="image">
            <div class="mt-3">
                <img src="{{ asset('images/' . $groomingservice->img_path) }}" class="rounded-lg w-20 h-20 object-cover border-2 border-[#A4B465] shadow-sm">
            </div>
            @error('img_path') <div class="text-[#FFCF50] text-sm mt-1">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex items-center space-x-4 mt-6">
        <button type="submit" class="px-6 py-2 bg-[#626F47] text-white font-semibold rounded-lg hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#A4B465] focus:ring-opacity-50 shadow-md">
            Update
        </button>
        <a href="{{ url()->previous() }}" class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none shadow-md">
            Cancel
        </a>
    </div>

    {!! Form::close() !!}
</div>
@endsection
