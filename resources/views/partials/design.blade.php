<nav class="bg-[#626F47] shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <!-- Left side: Logo and Links -->
            <div class="flex space-x-6">
                <a class="text-[#FFCF50] text-lg font-bold" href="{{ route('transact.index') }}">
                    <span class="text-[#A4B465]">PET</span>CLINIC
                </a>
                <a class="text-white hover:text-[#A4B465] transition" href="{{ url('customers') }}">Customers</a>

                @if (auth()->check() && auth()->user()->role === 'admin')
                    <a class="text-white hover:text-[#A4B465] transition" href="{{ url('employees') }}">Employees</a>
                @endif
                
                <a class="text-white hover:text-[#A4B465] transition" href="{{ url('grooming') }}">Grooming Services</a>
                <a class="text-white hover:text-[#A4B465] transition" href="{{ url('pets') }}">Pets</a>
                <a class="text-white hover:text-[#A4B465] transition" href="{{ url('consults') }}">Consultation</a>
                <a class="text-white hover:text-[#A4B465] transition" href="{{ route('getTransacts') }}">Transaction</a>
                <a class="text-white hover:text-[#A4B465] transition" href="{{ route('comment.pet') }}">Comment</a>

                @if (auth()->check() && auth()->user()->role === 'admin')
                    <a class="text-white hover:text-[#A4B465] transition" href="{{ route('chart.groomed') }}">Chart</a>
                @endif
            </div>

            <!-- Right side: Shopping Cart and User Management -->
            <div class="flex space-x-6 items-center">
                <!-- Shopping Cart -->
                <a href="{{ route('service.shoppingCart') }}" class="relative text-white hover:text-[#FFCF50] transition">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                    <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                        {{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}
                    </span>
                </a>

                <!-- User Management Dropdown -->
                <div class="relative">
                    <button id="userMenuButton" class="text-white bg-[#A4B465] hover:bg-[#FFCF50] py-1 px-3 rounded focus:outline-none transition duration-300">
                        <i class="fa fa-user"></i> User Management
                    </button>
                    <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-[#626F47] rounded shadow-lg opacity-0 invisible transition-all duration-300 transform scale-95">
                        @if (Auth::check())
                            @if (auth()->user()->role === 'admin')
                                <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.aprofile') }}">
                                    <strong>{{ Auth::User()->name }}</strong> - Admin
                                </a>
                                <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.logout') }}">Logout</a>
                            @elseif (auth()->user()->role === 'employee')
                                <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.eprofile') }}">
                                    <strong>{{ Auth::User()->name }}</strong> - Employee
                                </a>
                                <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.logout') }}">Logout</a>
                            @elseif (auth()->user()->role === 'customer')
                                <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.profile') }}">
                                    <strong>{{ Auth::User()->name }}</strong> - Customer
                                </a>
                                <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.logout') }}">Logout</a>
                            @endif
                        @else
                            <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.signup') }}">Signup as Customer</a>
                            <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.esignup') }}">Signup as Employee</a>
                            <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.asignup') }}">Signup as Admin</a>
                            <a class="text-white block px-4 py-2 text-sm hover:bg-[#A4B465] rounded transition" href="{{ route('user.signin') }}">Signin</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript for Dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const userMenuButton = document.getElementById("userMenuButton");
        const userDropdown = document.getElementById("userDropdown");

        userMenuButton.addEventListener("click", function () {
            userDropdown.classList.toggle("opacity-0");
            userDropdown.classList.toggle("invisible");
            userDropdown.classList.toggle("scale-95");
            userDropdown.classList.toggle("opacity-100");
            userDropdown.classList.toggle("visible");
            userDropdown.classList.toggle("scale-100");
        });

        document.addEventListener("click", function (event) {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add("opacity-0", "invisible", "scale-95");
                userDropdown.classList.remove("opacity-100", "visible", "scale-100");
            }
        });
    });
</script>
