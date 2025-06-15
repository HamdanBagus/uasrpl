<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    {{-- Latar belakang utama dengan gradient yang sesuai tema --}}
    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama untuk konten --}}
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    {{-- Hero Section --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-8 mb-12 pb-8 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-3xl lg:text-4xl font-extrabold text-gray-800 dark:text-white mb-4">Selamat Datang, Admin {{ $user->name }}! 👋</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">Ini adalah pusat kendali Anda. Kelola katalog tanaman dan pantau aktivitas sistem dengan mudah.</p>
                        </div>
                        <div class="flex justify-center lg:justify-end">
                            {{-- Anda bisa menaruh gambar ilustrasi admin di sini jika ada, contoh: --}}
                            <img src="{{ asset('images/tanaman.jpg') }}" alt="Ilustrasi Admin" class="w-64 h-64 sm:w-72 sm:h-72 lg:w-80 lg:h-80 object-contain rounded-xl shadow-lg transition-all duration-700 ease-in-out transform hover:scale-105 hover:shadow-2xl"> 
                            <!-- <div class="w-64 h-64 sm:w-72 sm:h-72 lg:w-80 lg:h-80 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-lg"> -->
                                <!-- <svg class="w-24 h-24 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg> -->
                            <!-- </div> -->
                        </div>
                    </div>

                    {{-- Kartu Statistik dan Fitur --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12">

                        {{-- Card Tanaman di Katalog --}}
                        <div class="bg-emerald-50 dark:bg-emerald-800/40 p-7 rounded-xl shadow-lg hover:shadow-xl border border-emerald-200 dark:border-emerald-700 transform hover:scale-[1.03] transition-all duration-300 ease-in-out">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xl font-bold text-emerald-800 dark:text-emerald-200">Tanaman di Katalog</h4>
                                <div class="p-2 bg-emerald-200 dark:bg-emerald-600 rounded-full">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-5xl font-extrabold text-emerald-900 dark:text-emerald-100 mb-2">{{ $jumlahTanaman }}</p>
                            <p class="text-base text-emerald-700 dark:text-emerald-300">Jenis Tanaman Tersimpan</p>
                            <div class="mt-6 text-right">
                                <a href="{{ route('admin.tanaman.index') }}" class="font-semibold text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-200 transition duration-150">Lihat Semua Tanaman &raquo;</a>
                            </div>
                        </div>

                        {{-- Card Statistik Pengguna --}}
                        <div class="bg-teal-50 dark:bg-teal-800/40 p-7 rounded-xl shadow-lg hover:shadow-xl border border-teal-200 dark:border-teal-700 transform hover:scale-[1.03] transition-all duration-300 ease-in-out">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xl font-bold text-teal-800 dark:text-teal-200">Pengguna Terdaftar</h4>
                                <div class="p-2 bg-teal-200 dark:bg-teal-600 rounded-full">
                                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.68-2.68L21 12l-2.68-2.68a9.38 9.38 0 00-2.68-2.68M9 4.72a9.38 9.38 0 00-2.68 2.68L3 12l2.68 2.68a9.38 9.38 0 002.68 2.68M9 4.72C7.382 5.094 5.976 5.904 4.72 7.22L3 12l1.72 4.78c1.256 1.316 2.662 2.126 4.28 2.51M15 19.128c1.618-.384 3.024-1.194 4.28-2.51L21 12l-1.72-4.78c-1.256-1.316-2.662-2.126-4.28-2.51m-4.28 9.21a3 3 0 100-6 3 3 0 000 6z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-5xl font-extrabold text-teal-900 dark:text-teal-100 mb-2">{{ $jumlahPengguna }}</p>
                            <p class="text-base text-teal-700 dark:text-teal-300">Total Akun Pengguna</p>
                            <div class="mt-6 text-right">
                                <a href="{{ route('admin.users.index') }}" class="font-semibold text-sm text-teal-600 dark:text-teal-400 hover:text-teal-800 dark:hover:text-teal-200 transition duration-150">Manajemen Pengguna &raquo;</a>
                            </div>
                        </div>

                        {{-- Card Lahan Terdaftar --}}
                        <div class="bg-green-50 dark:bg-green-800/40 p-7 rounded-xl shadow-lg hover:shadow-xl border border-green-200 dark:border-green-700 transform hover:scale-[1.03] transition-all duration-300 ease-in-out">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xl font-bold text-green-800 dark:text-green-200">Data Lahan</h4>
                                <div class="p-2 bg-green-200 dark:bg-green-600 rounded-full">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5V7.5m17.25 12V7.5m0 12A1.125 1.125 0 0021.75 18.375M3.375 7.5A1.125 1.125 0 012.25 6.375m19.5 0A1.125 1.125 0 0020.625 5.25m-17.25 0h17.25m-17.25 0A1.125 1.125 0 013.375 4.125m17.25 0A1.125 1.125 0 0020.625 3m-17.25 0h17.25M9 12l3 3m0 0l3-3m-3 3V3.375" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-5xl font-extrabold text-green-900 dark:text-green-100 mb-2">{{ $jumlahSemuaLahan }}</p>
                            <p class="text-base text-green-700 dark:text-green-300">Total Lahan Terdaftar</p>
                            <div class="mt-6 text-right">
                                <a href="{{ route('admin.all_lahans.index') }}" class="font-semibold text-sm text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200 transition duration-150">Lihat Semua Lahan &raquo;</a>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi Cepat --}}
                    <div class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white mb-6 text-center md:text-left">Aksi Cepat Admin:</h3>
                        <div class="flex flex-col sm:flex-row flex-wrap gap-4 justify-center md:justify-start">
                            <a href="{{ route('admin.tanaman.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Tanaman Baru
                            </a>
                            <a href="{{ route('admin.tanaman.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-emerald-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                Lihat Katalog Tanaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>