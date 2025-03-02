@extends('layouts.main')
@section('content')

<div class="page-content page-container" id="page-content">
    @foreach($employees as $employee)
    <div class="container mx-auto py-20">
        <div class="row flex justify-center">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full bg-white rounded-lg shadow-xl max-w-8xl mx-auto">
                    <div class="flex">
                        
                        <!-- Left Side - Profile Image -->
                        <div class="w-2/5 bg-gradient-to-r from-[#626F47] to-[#A4B465] rounded-l-lg py-16 px-8 flex flex-col items-center">
                            <div class="mb-10">
                                <img src="{{ asset('images/'.$employee->img_path) }}" alt="Profile Picture"
                                    class="w-48 h-48 rounded-full object-cover border-4 border-white shadow-xl"/>
                            </div>
                            <h6 class="text-5xl font-semibold text-white">{{ $employee->fname }} {{ $employee->lname }}</h6>
                            <p class="text-white mt-4 text-xl font-medium">Employee</p>
                        </div>

                        <!-- Right Side - Employee Details -->
                        <div class="w-3/5 px-16 py-12">
                            <h6 class="text-3xl font-semibold text-center mb-8 text-[#626F47]">INFORMATION</h6>
                            
                            <div class="grid grid-cols-2 gap-12">
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Email</p>
                                    <h6 class="text-gray-700 text-xl">{{ $employee->email }}</h6>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Phone</p>
                                    <h6 class="text-gray-700 text-xl">{{ $employee->phone }}</h6>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Address</p>
                                    <h6 class="text-gray-700 text-xl">{{ $employee->addressline }}</h6>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Zipcode</p>
                                    <h6 class="text-gray-700 text-xl">{{ $employee->zipcode }}</h6>
                                </div>
                            </div>

                            <!-- Social Links -->
                            <ul class="flex space-x-8 mt-12 justify-center">
                                <li><a href="#" class="text-[#626F47] hover:text-blue-500 text-3xl"><i class="mdi mdi-facebook"></i></a></li>
                                <li><a href="#" class="text-[#626F47] hover:text-blue-400 text-3xl"><i class="mdi mdi-twitter"></i></a></li>
                                <li><a href="#" class="text-[#626F47] hover:text-pink-500 text-3xl"><i class="mdi mdi-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
