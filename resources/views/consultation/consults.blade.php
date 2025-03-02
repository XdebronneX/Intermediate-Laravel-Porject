@extends('layouts.main')
@section('body')

<div class="container mx-auto px-6 py-10">
  <br />

  <a href="#" data-bs-toggle="modal" data-bs-target="#consultModal" class="py-2 px-4 bg-[#626F47] text-white rounded-lg shadow-md hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">
    <span class="glyphicon glyphicon-plus"></span>
    <strong>Consult Pets</strong>
  </a>

  <div class="mt-6">
    {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
  </div>
</div>

<!-- Modal -->
<div class="modal" id="consultModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:75%;">
    <div class="modal-content bg-white shadow-lg rounded-lg">
      <div class="modal-header text-center bg-[#626F47] text-white py-4 rounded-t-lg">
        <p class="modal-title w-100 font-bold text-xl">Consult Information</p>
        {{-- <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>

      <form method="post" action="{{ route('consult.store') }}">
        @csrf
        <div class="modal-body mx-3">

          <input type="hidden" name="emp_id" value="{{ App\Models\Employee::where('user_id', Auth::id())->pluck('emp_id')->first() }}">

          <div class="mb-5">
            <label for="observation" class="block font-semibold text-[#626F47]">Observation</label>
            <input type="text" id="observation" name="observation" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]">
          </div>

          <div class="mb-5">
            <label for="pet_id" class="block font-semibold text-[#626F47]">Pet</label>
            {!! Form::select('pet_id', App\Models\Pet::pluck('pname', 'pet_id'), null, ['class' => 'form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]']) !!}
          </div>

          <div class="mb-5">
            <label for="consult_cost" class="block font-semibold text-[#626F47]">Consult Cost</label>
            <input type="text" id="consult_cost" name="consult_cost" class="form-control w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#A4B465]">
          </div>

        <div class="mb-5">
    <label class="block font-semibold text-[#626F47]">Disease</label>
    <div class="flex flex-wrap border p-3 rounded-md bg-gray-100">
        @foreach($diseases as $disease)
            <div class="form-check form-check-inline w-1/3 mb-2">
                <input type="checkbox" name="disease_id[]" value="{{ $disease->disease_id }}" 
                    class="form-check-input"
                    {{ isset($selectedDiseases) && in_array($disease->disease_id, $selectedDiseases) ? 'checked' : '' }}>
                <label class="form-check-label text-[#626F47] ml-2">{{ $disease->disease_name }}</label>
            </div>
        @endforeach
    </div>
</div>




        </div>

        <div class="modal-footer flex justify-between bg-[#FFCF50] py-4 rounded-b-lg">
          <button type="submit" class="btn btn-success bg-[#626F47] text-white py-2 px-6 rounded-lg hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">
            Save
          </button>
          <a href="{{ url()->previous() }}" class="btn btn-light text-[#626F47] py-2 px-6 rounded-lg hover:bg-[#F2F2F2]">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush

@endsection
