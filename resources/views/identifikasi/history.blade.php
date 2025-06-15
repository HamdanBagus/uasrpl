<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Identifikasi Tanaman') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-50 dark:bg-green-700/30 border-l-4 border-green-500 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded-r-lg shadow-md mb-6 flex items-center" role="alert">
                            <svg class="w-6 h-6 mr-3 text-green-500 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <strong class="font-bold">Berhasil!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white mb-6 border-b pb-3 border-gray-200 dark:border-gray-700 inline-flex items-center w-full justify-center">
                        <svg class="w-8 h-8 mr-3 text-emerald-500 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.015 0-2.01.079-2.98.284A1.125 1.125 0 003 4.872v11.423a2.25 2.25 0 001.657 2.175 48.111 48.111 0 013.476.792c1.473.317 3.022.515 4.59.515 1.569 0 3.118-.198 4.59-.515a48.111 48.111 0 003.476-.792 2.25 2.25 0 001.657-2.175V4.872a1.125 1.125 0 00-.322-.923A9.01 9.01 0 0012 6.042z" />
                        </svg>
                        Riwayat Identifikasi Tanaman
                    </h3>

                    @if ($results->isEmpty())
                        <div class="bg-amber-50 dark:bg-amber-700/30 border-l-4 border-amber-500 dark:border-amber-600 text-amber-700 dark:text-amber-300 p-6 rounded-r-lg shadow-md text-center">
                            <svg class="mx-auto h-12 w-12 text-amber-400 dark:text-amber-500 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <p class="font-bold text-lg">Tidak Ada Riwayat Identifikasi</p>
                            <p class="mt-1">Anda belum melakukan identifikasi tanaman apa pun.</p>
                            <div class="mt-4">
                                <a href="{{ route('identifikasi.index') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-wider shadow-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Mulai Identifikasi Baru
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($results as $result)
                                <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 transform hover:scale-105 transition duration-200 ease-in-out">
                                    @if ($result->uploaded_image_path)
                                        <img src="{{ Storage::url($result->uploaded_image_path) }}" alt="{{ $result->plant_name }}" class="w-full h-48 object-cover">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-1">{{ $result->plant_name }}</h4>
                                        <p class="text-green-600 dark:text-green-400 font-semibold mb-2">{{ $result->probability }}% Cocok</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Diidentifikasi pada: {{ $result->created_at->format('d M Y, H:i') }}</p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('identifikasi.history_detail', $result) }}" class="text-sky-600 hover:text-sky-800 dark:text-sky-400 dark:hover:text-sky-300 font-medium text-sm">Lihat Detail</a>
                                            <form action="{{ route('identifikasi.history_delete', $result) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus hasil identifikasi ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-8">
                            {{ $results->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>