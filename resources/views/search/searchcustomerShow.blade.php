@extends('layouts.main')

@section('body')
<div class="flex items-center justify-center min-h-screen bg-[#A4B465] p-6">
    <div class="w-full max-w-5xl bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-[#626F47] text-center mb-6">Customer Service Records</h1>

        <table class="w-full border-collapse border border-[#626F47] rounded-lg overflow-hidden shadow-md">
            <thead class="bg-[#626F47] text-white">
                <tr>
                    <th class="py-3 px-6 text-left text-lg">Customer Name</th>
                    <th class="py-3 px-6 text-left text-lg">Pet Name</th>
                    <th class="py-3 px-6 text-left text-lg">Service Name</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($customershoww as $show)
                    <tr class="border-b border-[#A4B465] hover:bg-[#FFCF50] transition">
                        <td class="py-3 px-6">{{ $show->fname . ' ' . $show->lname }}</td>
                        <td class="py-3 px-6">{{ $show->pname }}</td>
                        <td class="py-3 px-6">{{ $show->service_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
