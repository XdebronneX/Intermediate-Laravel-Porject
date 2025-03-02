@extends('layouts.main')

@section('body')
<div class="flex items-center justify-center min-h-screen bg-[#A4B465] p-6">
    <div class="bg-[#626F47] p-8 rounded-2xl shadow-xl w-full max-w-lg transform transition-all scale-100 hover:scale-105">
        <form method="get" action="{{ route('search.customerquery') }}" class="flex items-center">
            <input type="text" name="searchCustomer" placeholder="Search..." required
                class="w-full p-4 text-lg font-semibold text-gray-800 bg-white border border-gray-300 rounded-l-lg shadow-md focus:outline-none focus:ring-2 focus:ring-[#FFCF50]">
            <button type="submit" 
                class="bg-[#FFCF50] text-[#626F47] px-6 py-4 rounded-r-lg shadow-md hover:bg-[#D9B040] transition duration-300 ease-in-out">
                🔍
            </button>
        </form>
    </div>
</div>

@if (isset($searchResults))
    <div class="container mx-auto px-6 py-10">
        @if ($searchResults->isEmpty())
            <h2 class="text-2xl font-bold text-center text-gray-900">
                😔 No results found for <span class="text-[#FFCF50]">"{{ $searchTerm }}"</span>.
            </h2>
        @else
            <h2 class="text-2xl font-bold text-center text-gray-900">
                🎉 Found {{ $searchResults->count() }} results for <span class="text-[#FFCF50]">"{{ $searchTerm }}"</span>.
            </h2>
            <hr class="my-4 border-t border-gray-300" />

            @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                <h3 class="text-xl font-semibold text-[#626F47] mt-6">{{ ucwords($type) }}</h3>
                <ul class="list-disc ml-6 space-y-2">
                    @foreach ($modelSearchResults as $searchResult)
                        <li>
                            <a href="{{ route('search.customershow', ['id' => $searchResult->url]) }}" 
                               class="text-[#FFCF50] font-semibold hover:underline hover:text-[#D9B040] transition duration-300 ease-in-out">
                               {{ $searchResult->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        @endif
    </div>
@endif
@endsection
