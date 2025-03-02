@extends('layouts.main')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md max-w-lg">
    <h2 class="text-2xl font-bold text-[#626F47] mb-6">Edit Employee Section</h2>

    {{ Form::model($transactions, ['route' => ['transacts.update', $transactions->groominginfo_id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

    <!-- Status Dropdown -->
    <div class="mb-4">
        <label for="status" class="block text-sm font-semibold text-[#626F47] mb-2">Status:</label>
        {{ Form::select('status', ['Processing' => 'Processing', 'Done' => 'Done'], null, ['class' => 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465]', 'placeholder' => 'Select Status']) }}
        @if($errors->has('status'))
            <small class="text-red-600">{{ $errors->first('status') }}</small>
        @endif
    </div>

    <!-- Buttons -->
    <div class="flex items-center space-x-4 mt-4">
        <button type="submit" class="px-6 py-2 bg-[#626F47] text-white font-semibold rounded-lg hover:bg-[#A4B465] focus:outline-none focus:ring-2 focus:ring-[#A4B465] shadow-md">
            Update
        </button>
        <a href="{{ url()->previous() }}" class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none shadow-md">
            Cancel
        </a>
    </div>

    {!! Form::close() !!}
</div>
@endsection
