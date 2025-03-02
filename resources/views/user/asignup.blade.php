@extends('layouts.main')
@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-[#626F47] p-8 rounded-lg shadow-lg w-96 text-white">
        <h2 class="text-2xl font-bold text-center mb-4">Admin Sign Up</h2>

        <form action="{{ route('user.asignup') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- First Name -->
            <div class="mb-4">
                <label for="fname" class="block text-sm font-medium">First Name:</label>
                <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                    class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @error('fname')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @error('email')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter a secure password"
                    class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @error('password')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium">Admin Image:</label>
                <input type="file" name="image" id="image"
                    class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @error('image')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
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
