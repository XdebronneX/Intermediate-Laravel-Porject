@extends('layouts.main')

@section('body')
<div class="flex items-center justify-center min-h-screen bg-[#A4B465] p-6">
    <div class="w-full max-w-4xl bg-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold text-[#626F47] text-center mb-6">🐾 Pet Disease Records</h1>

        @if ($petshoww->isEmpty())
            <p class="text-center text-lg text-gray-600">No disease records found for this pet.</p>
        @else
            <table class="w-full border-collapse border border-[#626F47] rounded-lg overflow-hidden shadow-md">
                <thead class="bg-[#626F47] text-white">
                    <tr>
                        <th class="py-4 px-6 text-left text-lg">Pet Name</th>
                        <th class="py-4 px-6 text-left text-lg">Disease</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($petshoww as $show)
                        <tr class="border-b border-[#A4B465] hover:bg-[#FFCF50] transition duration-300 ease-in-out">
                            <td class="py-4 px-6">{{ $show->pname }}</td>
                            <td class="py-4 px-6">{{ $show->disease_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
