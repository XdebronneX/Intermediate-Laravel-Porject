@extends('layouts.main')

@section('content')
<div class="container mx-auto px-6 py-10">
    <!-- Comments Container -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <div class="comment_block text-center">
            <img src="{{ asset('images/' . $serv->img_path) }}" class="w-44 h-44 object-cover mx-auto rounded-md">
            <h3 class="mt-4 font-bold text-lg text-[#626F47]">{{ $serv->service_name }}</h3>
            
            <!-- Comment Form -->
            <div class="mt-6">
                <form method="get" action="{{ route('comment.req') }}" class="flex flex-col md:flex-row items-center gap-3">
                    <input type="text" name="comment" placeholder="Join the conversation..." 
                           class="w-full md:w-3/4 p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]">
                    <input type="hidden" name="comid" value="{{ $comid }}">
                    
                    <button type="submit" class="bg-[#626F47] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">
                        Comment
                    </button>
                </form>
            </div>

            <!-- Comments Section -->
            <div class="mt-8">
                <ul class="space-y-4">
                    @foreach ($service as $ser)
                        <li class="bg-white p-4 rounded-lg shadow-md">
                            <div class="flex items-center space-x-3">
                                <div class="bg-gray-300 w-10 h-10 rounded-full"></div> <!-- Placeholder for avatar -->
                                <div>
                                    <p class="font-semibold text-[#626F47]">{{ $ser->name }}</p>
                                    <p class="text-gray-700">{{ $ser->comment }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
