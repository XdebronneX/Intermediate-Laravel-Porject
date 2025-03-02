@extends('layouts.main')

@section('title', 'Laravel Shopping Cart')

@section('content')
<div class="container mx-auto p-6">
    @if(Session::has('cart'))
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <form method="post" action="{{ route('service.checkout') }}" enctype="multipart/form-data">
                @csrf

                <!-- Pet Selection -->
                <div class="mb-4">
                    <label for="pet_id" class="block text-[#626F47] font-bold mb-2">Pet Name</label>
                    {!! Form::select('pet_id', $pets, null, [
                        'placeholder' => '******Please Choose!******',
                        'class' => 'w-full p-2 border rounded-lg focus:ring-2 focus:ring-[#FFCF50] text-gray-700'
                    ]) !!}
                    @if($errors->has('pet_id'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('pet_id') }}</p>
                    @endif
                </div>

                <!-- Cart Items -->
                <ul class="divide-y divide-gray-200">
                    @foreach($services as $service)
                        <li class="flex justify-between items-center py-3">
                            <div>
                                <span class="bg-[#FFCF50] text-white px-2 py-1 rounded-md text-sm">{{ $service['qty'] }}</span>
                                <span class="font-semibold text-[#626F47] ml-2">{{ $service['service']['service_name'] }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-[#A4B465] font-bold">₱{{ number_format($service['price'], 2) }}</span>
                                <a href="{{ route('service.remove', ['id' => $service['service']['service_id']]) }}" 
                                    class="text-red-500 hover:underline">Remove</a>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Total Price -->
                <div class="mt-6 text-center">
                    <h2 class="text-3xl font-bold text-[#626F47]">Total: ₱{{ number_format($totalPrice, 2) }}</h2>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-center space-x-4">
                    <button type="submit" class="bg-[#A4B465] text-white px-6 py-2 rounded-lg hover:bg-[#626F47] transition">
                        Checkout
                    </button>
                    <a href="{{ url()->previous() }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    @else
        <!-- Empty Cart Message -->
        <div class="flex flex-col items-center justify-center h-64 text-center">
            <img src="{{ asset('images/no-cart.png') }}" alt="No items in cart" class="w-32 h-32 mb-4">
            <h2 class="text-xl font-semibold text-[#626F47]">No Items in Cart!</h2>
            <p class="text-gray-500">Your cart is empty. Start adding services now.</p>
        </div>
    @endif
</div>
@endsection
