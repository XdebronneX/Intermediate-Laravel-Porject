@extends('layouts.main')
@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-[#626F47] p-8 rounded-lg shadow-lg w-full max-w-2xl text-white">
        <h2 class="text-2xl font-bold text-center mb-6">Customer Sign Up</h2>

        <form action="{{ route('user.signup') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Two-column layout for Title & First Name -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="title" class="block text-sm font-medium">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Enter your title"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('title')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="fname" class="block text-sm font-medium">First Name:</label>
                    <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('fname')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Two-column layout for Last Name & Zipcode -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="lname" class="block text-sm font-medium">Last Name:</label>
                    <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('lname')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="zipcode" class="block text-sm font-medium">Zipcode:</label>
                    <input type="text" name="zipcode" id="zipcode" placeholder="Enter your zipcode"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('zipcode')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Two-column layout for Address & Town -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="address" class="block text-sm font-medium">Address:</label>
                    <input type="text" name="addressline" id="address" placeholder="Enter your address"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('addressline')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="town" class="block text-sm font-medium">Town:</label>
                    <input type="text" name="town" id="town" placeholder="Enter your town"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('town')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Two-column layout for Phone & Customer Image -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="phone" class="block text-sm font-medium">Phone:</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('phone')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium">Customer Image:</label>
                    <input type="file" name="image" id="image"
                        class="w-full p-2 rounded border border-gray-300 text-gray-900">
                    @error('image')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Full-width input for Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @error('email')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Full-width input for Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter a secure password"
                    class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @error('password')
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
