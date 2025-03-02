@extends('layouts.main')
@section('body')

<div class="container py-10">
    <div class="flex justify-center">
        <button type="button" class="btn bg-[#626F47] text-white px-6 py-2 rounded-lg hover:bg-[#A4B465]" 
                data-bs-toggle="modal" data-bs-target="#petModal">
            + Create New Pet
        </button>
    </div>


    <!-- Pet Creation Modal -->
    <div class="modal fade" id="petModal" tabindex="-1" aria-labelledby="petModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-lg shadow-lg">
                
                <div class="modal-header bg-[#626F47] text-white">
                    <h5 class="modal-title w-100 text-center font-bold">Add New Pet</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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

                            <div>
                                <label class="block text-gray-700 font-semibold">Breed</label>
                                <input type="text" name="petb_id" value="{{ old('petb_id') }}" 
                                       class="form-control border-gray-300 rounded-lg p-2" placeholder="Enter breed">
                                @error('petb_id')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
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
                        <button type="button" class="btn bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
