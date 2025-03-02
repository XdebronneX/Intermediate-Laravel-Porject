@extends('layouts.main')
@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-[#626F47] p-8 rounded-lg shadow-lg w-full max-w-2xl text-white">
        <h2 class="text-2xl font-bold text-center mb-6">Employees Sign Up</h2>

        @if (count($errors) > 0)
            @include('layouts.flash-messages')
        @endif

        <form action="{{ route('user.esignup') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Position Selection -->
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium">Position:</label>
                <select class="w-full p-2 rounded border border-gray-300 text-gray-900" name="position" id="position">
                    <option value="Veterinarian">Veterinarian</option>
                    <option value="Assistant">Assistant</option>
                    <option value="Groomer">Groomer</option>
                </select>
            </div>

            <!-- Two-column layout for Title & First Name -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="title" class="block text-sm font-medium">Title:</label>
                    <input type="text" name="title" id="title" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>

                <div>
                    <label for="fname" class="block text-sm font-medium">First Name:</label>
                    <input type="text" name="fname" id="fname" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>
            </div>

            <!-- Two-column layout for Last Name & Zipcode -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="lname" class="block text-sm font-medium">Last Name:</label>
                    <input type="text" name="lname" id="lname" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>

                <div>
                    <label for="zipcode" class="block text-sm font-medium">Zipcode:</label>
                    <input type="text" name="zipcode" id="zipcode" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>
            </div>

            <!-- Two-column layout for Address & Phone -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="address" class="block text-sm font-medium">Address:</label>
                    <input type="text" name="addressline" id="address" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium">Phone:</label>
                    <input type="text" name="phone" id="phone" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>
            </div>

            <!-- Two-column layout for Email & Employee Image -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="town" class="block text-sm font-medium">Town:</label>
                    <input type="text" name="town" id="town" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium">Employee Image:</label>
                    <input type="file" name="image" id="image" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('image')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Full-width Password Input -->
            <div class="mb-4">
                <div>
                    <label for="email" class="block text-sm font-medium">Email:</label>
                    <input type="text" name="email" id="email" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">Password:</label>
                    <input type="password" name="password" id="password" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-[#FFCF50] text-[#626F47] font-bold py-2 px-4 rounded hover:bg-yellow-400 transition">
                Sign Up
            </button>
        </form>
    </div>
</div>

@endsection
