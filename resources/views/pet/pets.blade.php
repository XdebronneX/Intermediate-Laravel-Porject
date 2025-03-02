@extends('layouts.main')
@section('body')
  <div class="container mx-auto px-6 py-10">
    <br />
    <div class="mb-8">
      <form method="post" enctype="multipart/form-data" action="{{ url('/pet/import') }}">
        @csrf
        <div class="flex items-center justify-between mb-4">
          <input type="file" id="uploadName" name="pet_upload" required class="p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]">
          <button type="submit" class="ml-4 py-2 px-4 bg-[#626F47] text-white rounded-lg shadow-md hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">
            Import Excel File
          </button>
        </div>
        @error('pet_upload')
          <small class="text-red-500">{{ $message }}</small>
        @enderror
      </form>
    </div>

    <div>
      {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
    </div>

    <!-- Modal -->
    <div class="modal" id="petModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content bg-white shadow-lg rounded-lg">
          <div class="modal-header text-center bg-[#626F47] text-white py-4 rounded-t-lg">
            <p class="modal-title w-100 font-bold text-xl">Add New Pet</p>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form method="post" action="{{route('pet.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body mx-3">
              
              <input type="hidden" name="customer_id" value="{{ App\Models\Customer::where('user_id', Auth::id())->pluck('customer_id')->first() }}">

              <div class="mb-5">
                <label for="pname" class="block font-semibold text-[#626F47]">Pet Name</label>
                <input type="text" id="pname" name="pname" value="{{old('pname')}}" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]" placeholder="Pet name">
                @error('pname')
                  <div class="text-red-500">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-5">
                <label for="gender" class="block font-semibold text-[#626F47]">Gender</label>
                <input type="text" id="gender" name="gender" value="{{old('gender')}}" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]" placeholder="Gender">
                @error('gender')
                  <div class="text-red-500">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-5">
                <label for="breed" class="block font-semibold text-[#626F47]">Breed</label>
                <input type="text" id="breed" name="breed" value="{{old('breed')}}" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]" placeholder="Breed">
                @error('breed')
                  <div class="text-red-500">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-5">
                <label for="age" class="block font-semibold text-[#626F47]">Age</label>
                <input type="number" id="age" name="age" value="{{old('age')}}" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]" placeholder="Age">
                @error('age')
                  <div class="text-red-500">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-5">
                <label for="image" class="block font-semibold text-[#626F47]">Image</label>
                <input type="file" id="image" name="image" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]">
                @error('image')
                  <div class="text-red-500">{{ $message }}</div>
                @enderror
              </div>

            </div>

            <div class="modal-footer flex justify-between bg-[#FFCF50] py-4 rounded-b-lg">
              <button type="submit" class="btn btn-success bg-[#626F47] text-white py-2 px-6 rounded-lg hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">
                Save
              </button>
              <button class="btn btn-light text-[#626F47] py-2 px-6 rounded-lg hover:bg-[#F2F2F2]" data-dismiss="modal">
                Cancel
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
@push('scripts')
  {!! $dataTable->scripts() !!}
@endpush

@endsection
