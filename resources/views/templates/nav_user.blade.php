<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <title>Sch</title>
</head>

<body class="bg-gray-50">
    <header class="shadow-md bg-white">
        <nav class="bg-white shadow-sm relative z-10">
            <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-3 flex items-center justify-between">
                <!-- Brand -->
                <div class="flex items-center space-x-4 me-32">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Logo">
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="menu-toggle" class="block md:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Navigation Links -->
                <div id="menu" class="hidden md:flex items-center space-x-4">
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Men</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Women</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Kids</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">About</a>
                    <a href="{{ route('contact') }}"
                        class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Contact</a>
                </div>

                <!-- Search Bar -->
                <form class="hidden md:flex items-center max-w-sm mx-auto">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5"
                            placeholder="Search branch name..." required />
                    </div>
                    <button type="submit"
                        class="p-2.5 ml-2 text-sm font-medium text-white bg-gray-900 rounded-lg border border-gray-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>

                <!-- User Profile -->
                @if(Auth::check())
                <div class="relative">
                    <button type="button" id="dropdown-toggle" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ asset('images/user.png') }}" alt="User" class="w-8 h-8 rounded-full">
                        <span class="hidden md:block text-sm font-medium text-gray-800">{{ Auth::user()->name }}</span>
                    </button>
                    <div id="dropdown-user"
                        class="hidden absolute top-full mt-2 right-0 bg-white shadow-md rounded-lg overflow-hidden z-50">
                        <div class="px-4 py-3">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <ul>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Acount</a>
                            </li>
                            <li>
                                <a href="{{ route('cart.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cart</a>
                            </li>
                            <li>
                                <a href="{{ route('cart.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pesanan Saya</a>
                            </li>
                            <li><a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign Out</a></li>
                        </ul>
                    </div>
                </div>
                @else
                <div>
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Sign In</a>
                </div>
                @endif
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden px-4 py-2 bg-gray-50 border-t">
                <a href="#" class="block py-2 text-sm font-medium text-gray-600 hover:text-gray-500 transition">Men</a>
                <a href="#"
                    class="block py-2 text-sm font-medium text-gray-600 hover:text-gray-500 transition">Women</a>
                <a href="#" class="block py-2 text-sm font-medium text-gray-600 hover:text-gray-500 transition">Kids</a>
                <a href="#"
                    class="block py-2 text-sm font-medium text-gray-600 hover:text-gray-500 transition">About</a>
                <a href="{{ route('contact') }}"
                    class="block py-2 text-sm font-medium text-gray-600 hover:text-gray-500 transition">Contact</a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content_user')
    </main>


    <script>
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        document.getElementById('dropdown-toggle').addEventListener('click', () => {
            const dropdown = document.getElementById('dropdown-user');
            dropdown.classList.toggle('hidden');
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>