@extends('layouts.main')
@section('body')
  <div class="container mx-auto px-6 py-10">
    <br />

    <div class="mb-8">
      <form method="post" enctype="multipart/form-data" action="{{ url('/Grooming/import') }}">
        @csrf
        <div class="flex items-center justify-between mb-4">
          <input type="file" id="uploadName" name="grooming_upload" required class="p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]">
          <button type="submit" class="ml-4 py-2 px-4 bg-[#626F47] text-white rounded-lg shadow-md hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">Import Excel File</button>
        </div>
        @error('grooming_upload')
          <small class="text-red-500">{{ $message }}</small>
        @enderror
      </form>
    </div>

    <a href="#" data-bs-toggle="modal" data-bs-target="#serviceModal" class="btn btn-primary a-btn-slide-text">
      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
      <span><strong>Add new grooming</strong></span>
    </a>

    <div>
      {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
    </div>

    <div class="modal" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content bg-white shadow-lg rounded-lg">
          <div class="modal-header text-center bg-[#626F47] text-white py-4 rounded-t-lg">
            <p class="modal-title w-100 font-bold text-xl">Add New Grooming Service</p>
            {{-- <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}
          </div>

          <form method="POST" action="{{ route('grooming.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body mx-3">
              <div class="mb-5">
                <label for="service_name" class="block font-semibold text-[#626F47]">Service Name</label>
                <input type="text" id="service_name" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]" name="service_name">
              </div>

              <div class="mb-5">
                <label for="service_cost" class="block font-semibold text-[#626F47]">Service Cost</label>
                <input type="text" id="service_cost" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]" name="service_cost">
              </div>

              <div class="mb-5">
                <label for="image" class="block font-semibold text-[#626F47]">Customer Image</label>
                <input type="file" id="image" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]" name="image">
                @error('image')
                  <div class="alert alert-danger text-red-500">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="modal-footer flex justify-between bg-[#FFCF50] py-4 rounded-b-lg">
              <button type="submit" class="btn btn-success bg-[#626F47] text-white py-2 px-6 rounded-lg hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">Save</button>
              <button class="btn btn-light text-[#626F47] py-2 px-6 rounded-lg hover:bg-[#F2F2F2]" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    {{ $dataTable->scripts() }}
  @endpush
@endsection
