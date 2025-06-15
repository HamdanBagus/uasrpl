<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Lahan Anda') }}
        </h2>
    </x-slot>

    {{-- Latar belakang utama dengan gradient yang sesuai tema --}}
    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama untuk konten --}}
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    {{-- Pesan Sukses --}}
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

                    {{-- Header Konten: Judul dan Tombol Tambah --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 border-b pb-5 border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white inline-flex items-center mb-4 sm:mb-0">
                            <svg class="w-8 h-8 mr-3 text-green-500 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192A48.424 48.424 0 0112 3.75c1.398 0 2.752.223 4.048.636C17.179 4.443 18 5.332 18 6.388V7.5M12 12.75V18m-3.75 0h7.5M12 12.75S9.75 10.5 9.75 9C9.75 7.231 10.735 6 12 6s2.25 1.231 2.25 3c0 1.5-2.25 3.75-2.25 3.75z" />
                            </svg>
                            Daftar Lahan Anda
                        </h3>
                        <a href="{{ route('lahans.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Lahan Baru
                        </a>
                    </div>

                    {{-- Kondisi jika tidak ada lahan --}}
                    @if ($lahans->isEmpty())
                        <div class="bg-amber-50 dark:bg-amber-700/30 border-l-4 border-amber-500 dark:border-amber-600 text-amber-700 dark:text-amber-300 p-6 rounded-r-lg shadow-md text-center">
                            <svg class="mx-auto h-12 w-12 text-amber-400 dark:text-amber-500 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <p class="font-bold text-lg">Belum Ada Data Lahan</p>
                            <p class="mt-1">Anda belum memiliki data lahan yang tersimpan. Silakan tambahkan data lahan Anda untuk mendapatkan rekomendasi tanaman.</p>
                        </div>
                    @else
                        {{-- Tabel Data Lahan --}}
                        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700/60">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Lahan</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">pH Tanah</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Sinar Matahari</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($lahans as $lahan)
                                        <tr class="{{ $loop->even ? 'bg-gray-50 dark:bg-gray-800/50' : 'bg-white dark:bg-gray-800' }} hover:bg-gray-100 dark:hover:bg-gray-700/70 transition duration-150 ease-in-out">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $lahan->nama_lahan }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $lahan->ph_tanah }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($lahan->intensitas_sinar_matahari) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex items-center">
                                                <a href="{{ route('lahans.show', $lahan) }}" class="text-sky-600 hover:text-sky-800 dark:text-sky-400 dark:hover:text-sky-300 transition duration-150 ease-in-out px-2 py-1 rounded hover:bg-sky-100 dark:hover:bg-sky-700/50">Detail</a>
                                                <a href="{{ route('lahans.edit', $lahan) }}" class="text-amber-600 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300 transition duration-150 ease-in-out px-2 py-1 rounded hover:bg-amber-100 dark:hover:bg-amber-700/50">Edit</a>
                                                <form action="{{ route('lahans.destroy', $lahan) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition duration-150 ease-in-out px-2 py-1 rounded hover:bg-red-100 dark:hover:bg-red-700/50" onclick="return confirm('Apakah Anda yakin ingin menghapus data lahan ini?')">Hapus</button>
                                                </form>
                                                <a href="{{ route('rekomendasi.show', $lahan) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-white bg-teal-500 rounded-full hover:bg-teal-600 dark:bg-teal-600 dark:hover:bg-teal-500 transition duration-150 ease-in-out">
                                                    Rekomendasi
                                                    <svg class="w-3 h-3 ml-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination Links --}}
                        {{-- PENYESUAIAN DI SINI --}}
                        @if ($lahans instanceof \Illuminate\Pagination\AbstractPaginator && $lahans->hasPages())
                            <div class="mt-8">
                                {{ $lahans->links() }} {{-- Pastikan pagination view Anda sudah di-publish dan di-style dengan Tailwind --}}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>