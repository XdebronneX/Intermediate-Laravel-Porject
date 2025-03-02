@extends('layouts.main')

@section('title', 'Laravel Shopping Cart')

@section('content')
<div class="container mx-auto p-6">
    @if ($transacts->isEmpty())
        <div class="flex flex-col items-center justify-center h-64 text-center">
            <img src="{{ asset('images/no-service.png') }}" alt="No services" class="w-32 h-32 mb-4">
            <h2 class="text-xl font-semibold text-gray-600">No available services at the moment</h2>
            <p class="text-gray-500">Please check back later for new grooming services.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($transacts->chunk(10) as $itemtransact)
                @foreach ($itemtransact as $transact)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ asset('images/' . $transact->img_path) }}" 
                             alt="{{ $transact->service_name }}" 
                             class="w-full h-48 object-cover">

                        <div class="p-4 text-center">
                            <h3 class="text-lg font-bold text-[#626F47]">{{ $transact->service_name }}</h3>
                            <p class="text-md font-semibold text-gray-700 mt-1">₱{{ number_format($transact->service_cost, 2) }}</p>
                            
                            <div class="mt-4">
                                <a href="{{ route('service.addToCart', ['id' => $transact->service_id]) }}" 
                                    class="bg-[#FFCF50] text-[#626F47] font-bold py-2 px-4 rounded hover:bg-yellow-400 transition">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
</div>
@endsection
