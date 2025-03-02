@extends('layouts.main')
@section('body')
  <div class="container mx-auto px-6 py-10">
    <br />

    <div class="mb-8">
      <form method="post" enctype="multipart/form-data" action="{{ url('/employee/import') }}">
        @csrf
        <div class="flex items-center justify-between mb-4">
          <input type="file" id="uploadName" name="employee_upload" required class="px-4 py-3 border-2 border-[#626F47] bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] placeholder-gray-500">
          <button type="submit" class="ml-4 py-2 px-4 bg-[#626F47] text-white rounded-lg shadow-md hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">Import Excel File</button>
        </div>
        @error('employee_upload')
          <small class="text-red-500">{{ $message }}</small>
        @enderror
      </form>
    </div>

    <div>
      {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover'], true)}}
    </div>

    <div class="modal" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content bg-white shadow-lg rounded-lg">
          <div class="modal-header text-center bg-[#626F47] text-white py-4 rounded-t-lg">
            <p class="modal-title w-100 font-bold text-xl">Add New Employee</p>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form method="POST" action="{{url('employee')}}">
            @csrf
            <div class="modal-body mx-3">

              @php
                $inputStyles = "mt-1 block w-full px-4 py-3 border-2 border-[#626F47] bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] placeholder-gray-500";
              @endphp

              <div class="mb-5">
                <label for="position" class="block font-semibold text-[#626F47]">Position</label>
                <select class="{{ $inputStyles }}" name="position" id="position">
                  <option value="Veterinarian">Veterinarian</option>
                  <option value="Assistant">Assistant</option>
                  <option value="Groomer">Groomer</option>
                </select>
              </div>

              <div class="mb-5">
                <label for="title" class="block font-semibold text-[#626F47]">Title</label>
                <input type="text" id="title" class="{{ $inputStyles }}" name="title">
              </div>

              <div class="mb-5">
                <label for="fname" class="block font-semibold text-[#626F47]">First Name</label>
                <input type="text" id="fname" class="{{ $inputStyles }}" name="fname">
              </div>

              <div class="mb-5">
                <label for="lname" class="block font-semibold text-[#626F47]">Last Name</label>
                <input type="text" id="lname" class="{{ $inputStyles }}" name="lname">
              </div>

              <div class="mb-5">
                <label for="addressline" class="block font-semibold text-[#626F47]">Address</label>
                <input type="text" id="addressline" class="{{ $inputStyles }}" name="addressline">
              </div>

              <div class="mb-5">
                <label for="zipcode" class="block font-semibold text-[#626F47]">Zipcode</label>
                <input type="text" id="zipcode" class="{{ $inputStyles }}" name="zipcode">
              </div>

              <div class="mb-5">
                <label for="phone" class="block font-semibold text-[#626F47]">Phone</label>
                <input type="text" id="phone" class="{{ $inputStyles }}" name="phone">
              </div>

              <div class="mb-5">
                <label for="email" class="block font-semibold text-[#626F47]">Email</label>
                <input type="email" id="email" class="{{ $inputStyles }}" name="email">
              </div>

              <div class="mb-5">
                <label for="password" class="block font-semibold text-[#626F47]">Password</label>
                <input type="password" id="password" class="{{ $inputStyles }}" name="password">
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
    {!! $dataTable->scripts() !!}
  @endpush

@endsection
