@extends('layouts.main')

@section('title', 'Laravel Shopping Cart')

@section('content')
<div class="container mx-auto px-6 py-10">
    @foreach ($transacts->chunk(10) as $itemtransact)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($itemtransact as $transact)
                <div class="bg-white shadow-lg rounded-lg p-5 text-center">
                    <img src="{{ asset('images/' . $transact->img_path) }}" alt="{{ $transact->service_name }}" class="w-44 h-44 object-cover mx-auto rounded-md">
                    
                    <h3 class="mt-4 font-bold text-lg text-[#626F47]">{{ $transact->service_name }}</h3>
                    
                    <a href="{{ route('comment.petid', ['id' => $transact->service_id]) }}" 
                       class="mt-4 inline-block bg-[#626F47] text-white px-6 py-2 rounded-lg shadow-md hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">
                        Comment
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
