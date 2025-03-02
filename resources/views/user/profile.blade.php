@extends('layouts.main')
@section('content')

<div class="page-content page-container" id="page-content">
    @foreach($customers as $customer)
    <div class="container mx-auto py-20">
        <div class="row flex justify-center">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full bg-white rounded-lg shadow-xl max-w-8xl mx-auto">
                    <div class="flex">
                        
                        <!-- Left Side - Profile Image -->
                        <div class="w-2/5 bg-gradient-to-r from-[#626F47] to-[#A4B465] rounded-l-lg py-16 px-8 flex flex-col items-center">
                            <div class="mb-10">
                                <img src="{{ asset('images/'.$customer->img_path) }}" alt="Profile Picture"
                                     class="w-48 h-48 rounded-full object-cover border-4 border-white shadow-xl"/>
                            </div>
                            <h6 class="text-5xl font-semibold text-white">{{ $customer->title }}. {{ $customer->fname }} {{ $customer->lname }}</h6>
                            <p class="text-white mt-4 text-xl font-medium">Web Designer</p>

                            <div class="mt-8">
                                <a href="{{route('customer.edit', $customer->customer_id)}}" 
                                   class="text-[#FFCF50] text-xl font-semibold hover:underline">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                            </div>
                        </div>

                        <!-- Right Side - Customer Details -->
                        <div class="w-3/5 px-16 py-12">
                            <h6 class="text-3xl font-semibold text-center mb-8 text-[#626F47]">INFORMATION</h6>
                            
                            <div class="grid grid-cols-2 gap-12">
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Email</p>
                                    <h6 class="text-gray-700 text-xl">{{ $customer->email }}</h6>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Phone</p>
                                    <h6 class="text-gray-700 text-xl">{{ $customer->phone }}</h6>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Address</p>
                                    <h6 class="text-gray-700 text-xl">{{ $customer->addressline }}</h6>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Zipcode</p>
                                    <h6 class="text-gray-700 text-xl">{{ $customer->zipcode }}</h6>
                                </div>
                            </div>

                            <!-- Add Pet Button -->
                            <div class="mt-8 text-center">
                                {{-- <a href="{{ route('pet.create') }}"
                                   class="bg-black text-white px-6 py-3 rounded hover:bg-[#FFCF50] transition text-lg">
                                    Add My Pet
                                </a> --}}
                                <div class="flex justify-center">
        <button type="button" class="btn bg-[#626F47] text-white px-6 py-2 rounded-lg hover:bg-[#A4B465]" 
                data-bs-toggle="modal" data-bs-target="#petModal">
            + Create New Pet
        </button>
    </div>
 <div class="modal fade" id="petModal" tabindex="-1" aria-labelledby="petModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-lg shadow-lg">
                
                <div class="modal-header bg-[#626F47] text-white">
                    <h5 class="modal-title w-100 text-center font-bold">Add New Pet</h5>
                    {{-- <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>

                <form method="POST" action="{{ route('pet.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-6">
                        
                        <!-- Hidden Owner ID -->
                        <input type="hidden" name="customer_id" value="{{ App\Models\Customer::where('user_id', Auth::id())->pluck('customer_id')->first() }}" class="d-none">

                        <!-- Pet Name -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold">Pet Name</label>
                            <input type="text" name="pname" value="{{ old('pname') }}" 
                                   class="form-control border-gray-300 rounded-lg p-2" placeholder="Enter pet name">
                            @error('pname')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender & Breed -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-semibold">Gender</label>
                                <input type="text" name="gender" value="{{ old('gender') }}" 
                                       class="form-control border-gray-300 rounded-lg p-2" placeholder="Enter gender">
                                @error('gender')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
{{-- {!! Form::select('petb_id', \App\Models\Breed::pluck('pbreed', 'petb_id'), null, [
    'placeholder' => 'Select a breed...',
    'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400'
]) !!} --}}

                            <div>
                                <div>
                <label for="petb_id" class="block text-gray-700 font-medium mb-1">Pet Breed</label>
                {!! Form::select('petb_id', \App\Models\Breed::pluck('pbreed', 'petb_id'), null, [
                    'placeholder' => 'Select a breed...',
                    'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400'
                ]) !!}
                @if ($errors->has('petb_id'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('petb_id') }}</p>
                @endif
            </div>
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="mt-4">
                            <label class="block text-gray-700 font-semibold">Age</label>
                            <input type="number" name="age" value="{{ old('age') }}" 
                                   class="form-control border-gray-300 rounded-lg p-2" placeholder="Enter age">
                            @error('age')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mt-4">
                            <label class="block text-gray-700 font-semibold">Upload Image</label>
                            <input type="file" name="image" class="form-control border-gray-300 rounded-lg p-2">
                            @error('image')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer flex justify-between px-6 py-4 bg-gray-100 rounded-b-lg">
                        <button type="submit" class="btn bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            Save
                        </button>
                        <button type="button" class="btn bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
                            </div>

                            <!-- Social Links -->
                            <ul class="flex space-x-8 mt-12 justify-center">
                                <li><a href="#" class="text-[#626F47] hover:text-blue-500 text-3xl"><i class="mdi mdi-facebook"></i></a></li>
                                <li><a href="#" class="text-[#626F47] hover:text-blue-400 text-3xl"><i class="mdi mdi-twitter"></i></a></li>
                                <li><a href="#" class="text-[#626F47] hover:text-pink-500 text-3xl"><i class="mdi mdi-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
