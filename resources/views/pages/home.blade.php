@extends('templates.nav_user')
@section('content_user')
<div class="m-4">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
            @if (Session::get('failed'))
            <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                {{ Session::get('failed') }}
            </div>
            @endif
            <!-- Hero Section -->
            <div class="relative bg-white dark:bg-gray-800 overflow-hidden">
                <div class="max-w-7xl mx-auto">
                    <div
                        class="relative z-10 pb-8 bg-white dark:bg-gray-800 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                        <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 lg:mt-16 lg:px-8">
                            <div class="sm:text-center lg:text-left">
                                <h1
                                    class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                                    <span class="block xl:inline">Discover the Best</span>
                                    <span class="block text-gray-600 xl:inline">Products for You</span>
                                </h1>
                                <p
                                    class="mt-3 text-base text-gray-500 dark:text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                    Explore our collection of premium products designed to make your life better. Shop
                                    now and
                                    experience excellence!
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="#products"
                                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 md:py-4 md:text-lg md:px-10">
                                            Shop Now
                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="#about-us"
                                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-600 bg-white dark:bg-gray-800 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 md:py-4 md:text-lg md:px-10">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <section class="py-16 bg-gray-100 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Why Choose Us?</h2>
                        <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
                            We deliver unmatched quality and service to help you achieve more.
                        </p>
                    </div>
                    <div class="mt-12 grid gap-8 lg:grid-cols-3">
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                            <div class="mb-4">
                                <svg class="w-12 h-12 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m6 4V9a2 2 0 00-2-2H7a2 2 0 00-2 2v7m8-7h.01" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">High Quality</h3>
                            <p class="mt-4 text-gray-500 dark:text-gray-300">
                                We provide premium-grade products with guaranteed durability and performance.
                            </p>
                        </div>
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                            <div class="mb-4">
                                <svg class="w-12 h-12 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Fast Delivery</h3>
                            <p class="mt-4 text-gray-500 dark:text-gray-300">
                                Get your products delivered to your doorstep quickly and securely.
                            </p>
                        </div>
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                            <div class="mb-4">
                                <svg class="w-12 h-12 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a4 4 0 10-8 0v2m6 0h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2 2H9a2 2 0 01-2-2v-2m6 0v-4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Secure Payment</h3>
                            <p class="mt-4 text-gray-500 dark:text-gray-300">
                                Your transactions are safe and protected with our top-notch security.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Products Section -->
            <section id="products" class="py-16 bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Our Products</h2>
                        <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
                            Browse our handpicked collection tailored to your needs.
                        </p>
                    </div>
                    {{-- card product --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 p-6">
                        @foreach ($products as $product)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transform transition hover:scale-105 hover:shadow-xl">
                            <div class="bg-gray-100 p-4 flex justify-center rounded-t-lg">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="h-40 object-cover rounded-lg">
                            </div>
                            <div class="p-2 flex flex-col items-center">
                                <a href="{{ route('detail', $product->id) }}"
                                    class="text-lg font-bold text-gray-900 dark:text-white hover:text-gray-500 transition">
                                    {{ $product->name }}
                                </a>
                                <span class="text-lg font-semibold text-gray-800 dark:text-white mt-2">
                                    Rp. {{ number_format($product->price, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection