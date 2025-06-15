<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Katalog Tanaman') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <div class="mb-8 text-center md:text-left">
                        <h3 class="text-3xl lg:text-4xl font-extrabold text-gray-800 dark:text-white inline-flex items-center">
                            <svg class="w-10 h-10 mr-3 text-green-500 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            Jelajahi Dunia Tanaman
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg">Temukan beragam tanaman yang cocok untuk kebutuhan Anda.</p>
                    </div>

                    <form action="{{ route('katalog.index') }}" method="GET" class="mb-8 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg shadow-md">
                        <div class="flex flex-col sm:flex-row items-center gap-3">
                            <div class="relative flex-grow w-full sm:w-auto">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" placeholder="Cari nama, deskripsi, atau jenis tanah..."
                                       class="w-full pl-10 pr-3 py-2.5 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 transition-shadow duration-150 focus:shadow-md"
                                       value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2 hidden sm:inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('katalog.index') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg shadow-sm hover:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 text-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>

                    @if ($tanaman->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-3 text-xl font-semibold text-gray-700 dark:text-gray-300">Oops! Tidak Ada Hasil</h3>
                            <p class="mt-1 text-base text-gray-500 dark:text-gray-400">
                                @if(request('search'))
                                    Tidak ada tanaman yang cocok dengan pencarian "{{ request('search') }}".
                                @else
                                    Belum ada tanaman yang tersedia di katalog saat ini.
                                @endif
                            </p>
                            @if(request('search'))
                                <div class="mt-6">
                                    <a href="{{ route('katalog.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Hapus Pencarian & Lihat Semua
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                            @foreach ($tanaman as $item)
                                <div class="bg-white dark:bg-gray-700/80 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg hover:shadow-2xl transform transition-all duration-300 hover:scale-[1.03] flex flex-col overflow-hidden">
                                    <div class="flex-shrink-0 h-56 w-full relative">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-5 flex flex-col flex-grow">
                                        <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{ $item->nama }}</h4>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 leading-relaxed flex-grow">{{ Str::limit($item->deskripsi, 90) }}</p>

                                        <div class="mt-auto pt-4 border-t border-gray-200 dark:border-gray-600">
                                            <a href="{{ route('katalog.show', $item) }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-teal-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-full text-center">
                                                Lihat Detail
                                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Modifikasi Bagian Pagination --}}
                        @if ($tanaman instanceof \Illuminate\Pagination\LengthAwarePaginator && $tanaman->hasPages())
                            <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                                {{ $tanaman->links() }} {{-- Pastikan pagination view Anda sudah di-publish dan di-style dengan Tailwind --}}
                            </div>
                        @elseif (!($tanaman instanceof \Illuminate\Pagination\LengthAwarePaginator) && $tanaman->count() > 0)
                            <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Menampilkan semua {{ $tanaman->count() }} tanaman.</p>
                            </div>
                        @endif
                        {{-- Akhir Modifikasi Bagian Pagination --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>