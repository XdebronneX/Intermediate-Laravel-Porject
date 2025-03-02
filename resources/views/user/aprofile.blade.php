@extends('layouts.main')
@section('content')
<div class="page-content page-container" id="page-content">
    @foreach($admins as $admin)
    <div class="container mx-auto py-20">
        <div class="row flex justify-center">
            <div class="col-xl-12 col-md-12"> <!-- Full-width column for better layout -->
                <div class="card user-card-full bg-white rounded-lg shadow-xl max-w-8xl mx-auto"> <!-- Expanded max width -->
                    <div class="flex">
                        <!-- Left side - Profile Image & Info -->
                        <div class="w-2/5 bg-gradient-to-r from-[#626F47] to-[#A4B465] rounded-l-lg py-16 px-8 flex flex-col items-center"> <!-- Increased left side width to 2/5 -->
                            <div class="mb-10">
                                <img src="{{ asset('images/'.$admin->img_path) }}" alt="Profile Picture" class="w-48 h-48 rounded-full object-cover border-4 border-white shadow-xl" /> <!-- Larger profile image with shadow -->
                            </div>
                            <h6 class="text-5sl font-semibold text-white">{{ $admin->fname }}</h6> <!-- Larger name -->
                            <p class="text-white mt-4 text-xl font-medium">Web Designer</p>
                            <i class="mdi mdi-square-edit-outline feather icon-edit mt-8 text-white text-2xl"></i> <!-- Larger edit icon -->
                        </div>

                        <!-- Right side - User Info -->
                        <div class="w-3/5 px-16 py-12"> <!-- Increased right side width to 3/5 -->
                            <h6 class="text-3xl font-semibold text-center mb-8 text-[#626F47]">INFORMATION</h6>
                            <div class="grid grid-cols-2 gap-12">
                                <div>
                                    <p class="font-semibold text-[#626F47] text-lg">Email</p>
                                    <h6 class="text-gray-700 text-xl">{{ $admin->email }}</h6>
                                </div>
                               
                            </div>
                            <ul class="flex space-x-8 mt-12">
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
