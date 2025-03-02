@extends('layouts.main')

@section('content')
<div class="container mx-auto p-8 bg-gray-50 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-[#626F47] mb-6">Edit Customer</h2>

    {{ Form::model($customer, ['route' => ['customer.update', $customer->customer_id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

    <!-- Form Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @php
            $inputStyles = "mt-1 block w-full px-4 py-3 border-2 border-[#626F47] bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] placeholder-gray-500";
        @endphp

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-semibold text-[#626F47]">Title:</label>
            {{ Form::text('title', null, ['class' => $inputStyles, 'placeholder' => 'Enter Title']) }}
            @error('title') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- First Name -->
        <div>
            <label for="fname" class="block text-sm font-semibold text-[#626F47]">First Name:</label>
            {{ Form::text('fname', null, ['class' => $inputStyles, 'placeholder' => 'Enter First Name']) }}
            @error('fname') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label for="lname" class="block text-sm font-semibold text-[#626F47]">Last Name:</label>
            {{ Form::text('lname', null, ['class' => $inputStyles, 'placeholder' => 'Enter Last Name']) }}
            @error('lname') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Address Line -->
        <div>
            <label for="addressline" class="block text-sm font-semibold text-[#626F47]">Address Line:</label>
            {{ Form::text('addressline', null, ['class' => $inputStyles, 'placeholder' => 'Enter Address']) }}
            @error('addressline') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Zipcode -->
        <div>
            <label for="zipcode" class="block text-sm font-semibold text-[#626F47]">Zipcode:</label>
            {{ Form::text('zipcode', null, ['class' => $inputStyles, 'placeholder' => 'Enter Zipcode']) }}
            @error('zipcode') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-[#626F47]">Phone:</label>
            {{ Form::text('phone', null, ['class' => $inputStyles, 'placeholder' => 'Enter Phone Number']) }}
            @error('phone') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
        </div>

        <!-- Email -->
        <div>
            @foreach($users as $user)
            <label for="email" class="block text-sm font-semibold text-[#626F47]">Email:</label>
            {{ Form::text('email', $user->email, ['class' => $inputStyles, 'placeholder' => 'Enter Email']) }}
            @error('email') <small class="text-[#FFCF50]">{{ $message }}</small> @enderror
            @endforeach
        </div>

        <!-- Password -->
        <div>
            @foreach($users as $user)
            <label for="password" class="block text-sm font-semibold text-[#626F47]">Password:</label>
            <input type="password" class="{{ $inputStyles }}" name="password" id="password" value="{{ old('password', $user->password) }}" placeholder="Enter Password">
            @error('password') <div class="text-[#FFCF50] text-sm mt-1">{{ $message }}</div> @enderror
            @endforeach
        </div>

        <!-- Image Upload -->
        <div class="col-span-2">
            <label for="image" class="block text-sm font-semibold text-[#626F47]">Customer Image:</label>
            <input type="file" class="{{ $inputStyles }}" id="image" name="image">
            <div class="mt-3">
                <img src="{{ asset('images/'.$customer->img_path) }}" class="rounded-full w-16 h-16 object-cover border-2 border-[#A4B465] shadow-sm">
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
