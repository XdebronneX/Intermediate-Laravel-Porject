@extends('layouts.main')

@section('content')
<div class="container mx-auto p-8 bg-gray-50 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-[#626F47] mb-6 flex items-center">
        <i class="fas fa-paw text-[#A4B465] mr-2"></i> Edit Pet
    </h2>

    {{ Form::model($pet, ['route' => ['pet.update', $pet->pet_id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

    <!-- Form Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @php
            $inputStyles = "mt-1 block w-full px-4 py-3 border-2 border-[#626F47] bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] placeholder-gray-500 shadow-sm";
        @endphp

        <!-- Pet Name -->
        <div>
            <label for="pname" class="block text-sm font-semibold text-[#626F47]">Pet Name:</label>
            {{ Form::text('pname', null, ['class' => $inputStyles, 'placeholder' => 'Enter Pet Name']) }}
            @error('pname') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Owner -->
        <div>
            <label for="customer_id" class="block text-sm font-semibold text-[#626F47]">Owner:</label>
            {{ Form::select('customer_id', $customers, $pet->customer_id, ['class' => $inputStyles, 'placeholder' => 'Select Owner']) }}
            @error('customer_id') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Breed -->
        <div>
            <label for="petb_id" class="block text-sm font-semibold text-[#626F47]">Breed:</label>
            <select name="petb_id" class="{{ $inputStyles }}">
                <option value="">Select Breed</option>
                @foreach($breeds as $breed)
                    <option value="{{ $breed->petb_id }}" {{ $pet->petb_id == $breed->petb_id ? 'selected' : '' }}>
                        {{ $breed->pbreed }}
                    </option>
                @endforeach
            </select>
            @error('petb_id') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Gender -->
        <div>
            <label for="gender" class="block text-sm font-semibold text-[#626F47]">Pet Gender:</label>
            {{ Form::text('gender', null, ['class' => $inputStyles, 'placeholder' => 'Enter Gender']) }}
            @error('gender') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Age -->
        <div>
            <label for="age" class="block text-sm font-semibold text-[#626F47]">Pet Age:</label>
            {{ Form::text('age', null, ['class' => $inputStyles, 'placeholder' => 'Enter Age']) }}
            @error('age') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Image Upload -->
        <div class="col-span-2 lg:col-span-3">
            <label for="image" class="block text-sm font-semibold text-[#626F47]">Pet Image:</label>
            <input type="file" class="{{ $inputStyles }}" id="image" name="image">
            <div class="mt-3">
                <img src="{{ asset('images/' . $pet->img_path) }}" class="rounded-lg w-32 h-32 object-cover border-2 border-[#A4B465] shadow-md">
            </div>
            @error('img_path') <div class="text-[#FFCF50] text-sm mt-1">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex items-center space-x-4 mt-6">
        <button type="submit" class="px-6 py-2 bg-[#626F47] text-white font-semibold rounded-lg hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#A4B465] focus:ring-opacity-50 shadow-md transition">
            Update
        </button>
        <a href="{{ url()->previous() }}" class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none shadow-md transition">
            Cancel
        </a>
    </div>

    {!! Form::close() !!}
</div>
@endsection
