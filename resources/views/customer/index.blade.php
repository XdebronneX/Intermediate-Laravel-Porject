@extends('layouts.main')

@section('content')
<div class="container mx-auto py-8">
    <!-- Success Message -->
    {{-- @if ( Session::has('success'))
      <div class="bg-green-500 text-white px-6 py-4 mb-4 rounded-lg shadow-md flex items-center justify-between">
        <span class="font-semibold">{{ Session::get('success') }}</span>
        <button type="button" class="text-white" data-dismiss="alert">×</button>
      </div>
    @endif --}}

    <!-- Search Form (Optional, If Needed) -->
    {{-- @include('partials.search') --}}

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full table-auto">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-6 py-3 text-left text-gray-700">ID</th>
            <th class="px-6 py-3 text-left text-gray-700">Title</th>
            <th class="px-6 py-3 text-left text-gray-700">Fname</th>
            <th class="px-6 py-3 text-left text-gray-700">Lname</th>
            <th class="px-6 py-3 text-left text-gray-700">Address</th>
            <th class="px-6 py-3 text-left text-gray-700">Phone</th>
            <th class="px-6 py-3 text-left text-gray-700">Zipcode</th>
            <th class="px-6 py-3 text-left text-gray-700">Pet Image</th>
            <th class="px-6 py-3 text-left text-gray-700">Pets</th>
            <th class="px-6 py-3 text-center text-gray-700" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($customers as $customer)
            <tr class="border-t hover:bg-gray-50">
              <td class="px-6 py-4">{{ $customer->customer_id }}</td>
              <td class="px-6 py-4">{{ $customer->title }}</td>
              <td class="px-6 py-4">{{ $customer->fname }}</td>
              <td class="px-6 py-4">{{ $customer->lname }}</td>
              <td class="px-6 py-4">{{ $customer->addressline }}</td>
              <td class="px-6 py-4">{{ $customer->phone }}</td>
              <td class="px-6 py-4">{{ $customer->zipcode }}</td>
              <td class="px-6 py-4">
                <img src="{{ asset('images/'.$customer->img_path) }}" width="80" height="80" class="rounded-full object-cover">
              </td>
              <td class="px-6 py-4">
                @foreach($customer->pets as $pet)
                  <li>{{ $pet->pname }}</li>
                @endforeach
              </td>
              <td class="px-6 py-4 text-center">
                @if($customer->deleted_at)
                  <i class="fas fa-eye text-gray-400 text-xl"></i>
                @else
                  <a href="{{ route('customer.show', $customer->customer_id) }}" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-eye text-xl"></i>
                  </a>
                @endif
              </td>
              <td class="px-6 py-4 text-center">
                @if($customer->deleted_at)
                  <i class="fas fa-user-edit text-gray-400 text-xl"></i>
                @else
                  <a href="{{ route('customer.edit', $customer->customer_id) }}" class="text-yellow-500 hover:text-yellow-700">
                    <i class="fas fa-user-edit text-xl"></i>
                  </a>
                @endif
              </td>
              <td class="px-6 py-4 text-center">
                @if($customer->deleted_at)
                  <i class="fas fa-user-times text-gray-400 text-xl"></i>
                @else
                  {!! Form::open(['route' => ['customer.destroy', $customer->customer_id], 'method' => 'DELETE']) !!}
                    <button type="submit" class="text-red-500 hover:text-red-700">
                      <i class="fas fa-user-times text-xl"></i>
                    </button>
                  {!! Form::close() !!}
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="mt-4">
        {{ $customers->links() }}
      </div>
    </div>
</div>
@endsection
