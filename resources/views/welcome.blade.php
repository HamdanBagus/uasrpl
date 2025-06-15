<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Rekomendasi Tanaman') }}</title> {{-- Ganti judul website --}}

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900 selection:bg-indigo-500 selection:text-white">
            {{-- Background Image Section --}}
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/tanaman.jpg') }}');">
                <div class="absolute inset-0 bg-black opacity-60"></div> {{-- Overlay gelap untuk teks lebih jelas --}}
            </div>

            {{-- Header Navigation (Login/Register) --}}
            <header class="relative z-10 w-full p-6 text-right">
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-300 dark:hover:text-white dark:focus:ring-offset-gray-800"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-300 dark:hover:text-white dark:focus:ring-offset-gray-800"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-300 dark:hover:text-white dark:focus:ring-offset-gray-800"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            {{-- Main Content / Hero Section --}}
            <main class="relative z-10 flex flex-col items-center justify-center min-h-screen text-center px-4">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 leading-tight shadow-text"> {{-- Shadow text untuk keterbacaan --}}
                    Temukan Tanaman Terbaik<br>untuk Lahan Anda
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-10 max-w-2xl">
                    Dapatkan rekomendasi tanaman yang akurat berdasarkan karakteristik lahan Anda.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    @guest
                        <a href="{{ route('register') }}"
                           class="px-8 py-4 bg-green-600 text-white font-bold text-lg rounded-full shadow-lg hover:bg-green-700 transition duration-300 transform hover:scale-105">
                            Mulai Sekarang!
                        </a>
                        <a href="{{ route('login') }}"
                           class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold text-lg rounded-full shadow-lg hover:bg-white hover:text-gray-800 transition duration-300 transform hover:scale-105">
                            Jelajahi Katalog
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}"
                           class="px-8 py-4 bg-green-600 text-white font-bold text-lg rounded-full shadow-lg hover:bg-green-700 transition duration-300 transform hover:scale-105">
                            Pergi ke Dashboard
                        </a>
                        <a href="{{ route('katalog.index') }}"
                           class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold text-lg rounded-full shadow-lg hover:bg-white hover:text-gray-800 transition duration-300 transform hover:scale-105">
                            Lihat Katalog
                        </a>
                    @endguest
                </div>
            </main>

            {{-- Optional Footer --}}
            <footer class="relative z-10 w-full p-4 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Rekomendasi Tanaman. All rights reserved.
            </footer>
        </div>

        @push('styles')
        <style>
            .shadow-text {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            }
        </style>
        @endpush
    </body>
</html>