@extends('layouts.main')
@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-[#626F47] p-8 rounded-lg shadow-lg w-96 text-white">
        <h2 class="text-2xl font-bold text-center mb-4">Login</h2>

        @if (count($errors) > 0)
            @include('layouts.flash-messages')
        @endif

        <form action="{{ route('user.signin') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email:</label>
                <input type="text" name="email" id="email" placeholder="Enter your email" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @if($errors->has('email'))
                    <div class="text-red-400 text-sm mt-1">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" class="w-full p-2 rounded border border-gray-300 text-gray-900">
                @if($errors->has('password'))
                    <div class="text-red-400 text-sm mt-1">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <button type="submit" class="w-full bg-[#FFCF50] text-[#626F47] font-bold py-2 px-4 rounded hover:bg-yellow-400 transition">Sign In</button>
        </form>
    </div>
</div>

@endsection
