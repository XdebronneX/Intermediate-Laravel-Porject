@extends('layouts.main')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-[#626F47] mb-6">Edit Consultation</h2>

    {{ Form::model($consult, ['route' => ['consult.update', $consult->consult_id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @php
            $inputStyles = "mt-1 block w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] placeholder-gray-500";
            $errorStyles = "text-red-600 text-sm mt-1";
        @endphp

        <!-- Veterinarian -->
        <div>
            <label class="block text-sm font-semibold text-[#626F47]">Veterinarian:</label>
            {!! Form::select('emp_id', App\Models\Employee::pluck('lname', 'emp_id'), null, ['class' => $inputStyles]) !!}
            @error('emp_id') <small class="{{ $errorStyles }}">{{ $message }}</small> @enderror
        </div>

        <!-- Pet -->
        <div>
            <label class="block text-sm font-semibold text-[#626F47]">Pet:</label>
            {!! Form::select('pet_id', App\Models\Pet::pluck('pname', 'pet_id'), null, ['class' => $inputStyles]) !!}
            @error('pet_id') <small class="{{ $errorStyles }}">{{ $message }}</small> @enderror
        </div>

        <!-- Observation -->
        <div class="col-span-2">
            <label class="block text-sm font-semibold text-[#626F47]">Observation:</label>
            {!! Form::text('observation', $consult->observation, ['class' => $inputStyles, 'placeholder' => 'Enter Observation']) !!}
            @error('observation') <small class="{{ $errorStyles }}">{{ $message }}</small> @enderror
        </div>

        <!-- Consult Cost -->
        <div>
            <label class="block text-sm font-semibold text-[#626F47]">Consult Cost:</label>
            {!! Form::text('consult_cost', $consult->consult_cost, ['class' => $inputStyles, 'placeholder' => 'Enter Cost']) !!}
            @error('consult_cost') <small class="{{ $errorStyles }}">{{ $message }}</small> @enderror
        </div>

        <!-- Diseases -->
        <div class="col-span-2">
            <label class="block text-sm font-semibold text-[#626F47]">Diseases:</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 bg-gray-100 p-4 rounded-lg">
                @foreach ($diseases as $disease)
                    <div class="flex items-center space-x-2">
                        {!! Form::checkbox('disease_id[]', $disease->disease_id, in_array($disease->disease_id, $selectedDiseases), ['class' => 'form-checkbox h-5 w-5 text-[#626F47] rounded-md focus:ring-[#A4B465]']) !!}
                        <span class="text-gray-700">{{ $disease->disease_name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex items-center space-x-4 mt-6">
        <button type="submit" class="px-6 py-2 bg-[#626F47] text-white font-semibold rounded-lg hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#A4B465] shadow-md">
            Update
        </button>
        <a href="{{ url()->previous() }}" class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none shadow-md">
            Cancel
        </a>
    </div>

    {!! Form::close() !!}
</div>
@endsection
