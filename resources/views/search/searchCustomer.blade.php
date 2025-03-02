@extends('layouts.main')

@section('body')
<div class="flex items-center justify-center min-h-screen bg-[#A4B465] p-6">
    <div class="w-full max-w-4xl bg-white p-8 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold text-[#626F47] text-center mb-6">Search Customers</h1>

        <!-- Search Box -->
        <div class="relative flex items-center bg-[#626F47] rounded-full p-3 shadow-lg">
            <form method="get" action="{{ route('search.customerquery') }}" class="flex w-full">
                <input 
                    type="text" 
                    name="searchCustomer" 
                    placeholder="Search..." 
                    required 
                    class="w-full bg-transparent text-white placeholder-[#FFCF50] text-xl px-4 focus:outline-none"
                />
                <button type="submit" class="p-2 bg-[#FFCF50] text-[#626F47] rounded-full shadow-md hover:bg-[#A4B465] transition">
                    🔍
                </button>
            </form>
        </div>

        <!-- Search Results -->
        @if (isset($searchResults))
            <div class="mt-8">
                @if ($searchResults->isEmpty())
                    <h2 class="text-center text-xl text-[#626F47]">
                        Sorry, no results found for <span class="text-[#FFCF50]">"{{ $searchTerm }}"</span>.
                    </h2>
                @else
                    <h2 class="text-center text-xl font-semibold text-[#626F47]">
                        Found {{ $searchResults->count() }} results for <span class="text-[#FFCF50]">"{{ $searchTerm }}"</span>.
                    </h2>
                    <hr class="my-4 border-t border-[#A4B465]" />

                    @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                        <h3 class="text-lg font-bold text-[#626F47] mt-4">{{ ucwords($type) }}</h3>
                        <ul class="space-y-2">
                            @foreach ($modelSearchResults as $searchResult)
                                <li>
                                    <a href="{{ route('search.customershow', ['id' => $searchResult->url]) }}" 
                                       class="text-blue-600 hover:underline">
                                       {{ $searchResult->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
