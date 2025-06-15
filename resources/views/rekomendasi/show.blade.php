<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rekomendasi Tanaman untuk Lahan: ') . $lahan->nama_lahan }}
        </h2>
    </x-slot>

    {{-- Latar belakang utama dengan gradient yang sesuai tema --}}
    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama untuk konten --}}
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    {{-- Judul Bagian Parameter Lahan --}}
                    <div class="flex items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                        <svg class="w-8 h-8 mr-3 text-emerald-500 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white">Parameter Lahan Anda</h3>
                    </div>

                    {{-- Card untuk parameter lahan --}}
                    <div class="bg-emerald-50 dark:bg-emerald-800/40 p-6 rounded-xl shadow-lg border border-emerald-200 dark:border-emerald-700 mb-10">
                        <ul class="list-none space-y-3 text-base text-gray-800 dark:text-gray-200">
                            <li><strong class="font-semibold text-emerald-700 dark:text-emerald-300 w-40 inline-block">Nama Lahan:</strong> {{ $lahan->nama_lahan }}</li>
                            <li><strong class="font-semibold text-emerald-700 dark:text-emerald-300 w-40 inline-block">pH Tanah:</strong> {{ $lahan->ph_tanah }}</li>
                            <li><strong class="font-semibold text-emerald-700 dark:text-emerald-300 w-40 inline-block">Sinar Matahari:</strong> {{ ucfirst($lahan->intensitas_sinar_matahari) }}</li>
                            <li><strong class="font-semibold text-emerald-700 dark:text-emerald-300 w-40 inline-block">Kelembaban Tanah:</strong> {{ ucfirst($lahan->kelembaban_tanah) }}</li>
                            <li><strong class="font-semibold text-emerald-700 dark:text-emerald-300 w-40 inline-block">Drainase Tanah:</strong> {{ ucfirst($lahan->drainase_tanah) }}</li>
                            <li><strong class="font-semibold text-emerald-700 dark:text-emerald-300 w-40 inline-block">Jenis Tanah:</strong> {{ $lahan->jenis_tanah }}</li>
                            <li><strong class="font-semibold text-emerald-700 dark:text-emerald-300 w-40 inline-block">Ketinggian (MDPL):</strong> {{ $lahan->ketinggian_mdpl ?? '-' }}</li>
                        </ul>
                    </div>

                    {{-- Judul Bagian Rekomendasi Tanaman --}}
                    <div class="flex items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                         <svg class="w-8 h-8 mr-3 text-teal-500 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L1.875 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09l2.846.813-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.25 12h.008v.008h-.008V12zm0 0h.008v.008h-.008V12zm0 0h.008v.008h-.008V12zm0-3.75h.008v.008h-.008V8.25zm0 7.5h.008v.008h-.008v-.008zm0-3.75h.008v.008h-.008V12z" />
                        </svg>
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white">Rekomendasi Tanaman Untuk Anda</h3>
                    </div>

                    @if ($recommendedTanaman->isEmpty())
                        <div class="bg-amber-50 dark:bg-amber-700/30 border-l-4 border-amber-500 dark:border-amber-600 text-amber-700 dark:text-amber-300 p-6 rounded-r-lg shadow-md text-center flex flex-col items-center">
                            <svg class="h-12 w-12 text-amber-400 dark:text-amber-500 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <p class="font-bold text-lg">Maaf, Belum Ada Rekomendasi Tepat</p>
                            <p class="mt-1">Tidak ada tanaman yang sangat cocok berdasarkan kriteria lahan Anda saat ini. Anda bisa mencoba mengubah parameter lahan Anda atau menambahkan lebih banyak variasi tanaman di katalog kami.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                            @foreach ($recommendedTanaman as $tanaman)
                                <div class="bg-white dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 rounded-xl shadow-lg hover:shadow-2xl p-6 flex flex-col transform hover:scale-[1.03] transition-all duration-300 ease-in-out">
                                    <div class="flex-shrink-0 mb-4 text-center">
                                        @if ($tanaman->gambar)
                                            <img src="{{ asset('storage/' . $tanaman->gambar) }}" alt="{{ $tanaman->nama }}" class="h-36 w-36 object-cover rounded-full mx-auto border-4 border-green-300 dark:border-green-600 shadow-md">
                                        @else
                                            <div class="h-36 w-36 bg-gray-200 dark:bg-gray-600 rounded-full mx-auto border-4 border-gray-300 dark:border-gray-500 shadow-md flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2 text-center">{{ $tanaman->nama }}</h4>
                                    <div class="text-center mb-4">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-200">
                                            Cocok {{ round($tanaman->score_kecocokan, 1) }}%
                                        </span>
                                    </div>

                                    <div class="flex-grow border-t dark:border-gray-600 pt-4 mt-auto">
                                        <p class="text-gray-700 dark:text-gray-300 text-sm mb-1 font-semibold">Deskripsi Singkat:</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 leading-relaxed">{{ Str::limit($tanaman->deskripsi, 100) }}</p>

                                        <p class="text-gray-700 dark:text-gray-300 text-sm mb-1 font-semibold">Detail Kecocokan:</p>
                                        <ul class="text-xs space-y-1 mb-4 bg-gray-100 dark:bg-gray-600/50 p-3 rounded-md border border-gray-200 dark:border-gray-500">
                                            @foreach ($tanaman->match_details as $detail)
                                                <li class="flex items-center {{ Str::contains($detail, 'TIDAK cocok') || Str::contains($detail, 'tidak cocok') ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                                                    @if (Str::contains($detail, 'TIDAK cocok') || Str::contains($detail, 'tidak cocok'))
                                                        <svg class="w-4 h-4 mr-1.5 text-red-500 dark:text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @else
                                                        <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @endif
                                                    <span class="flex-1">{{ $detail }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="mt-auto pt-4 border-t dark:border-gray-600">
                                        <a href="{{ route('katalog.show', $tanaman) }}" class="w-full inline-flex items-center justify-center px-6 py-3 bg-teal-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Lihat Detail Tanaman
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-12 text-right border-t dark:border-gray-700 pt-8">
                        <a href="{{ route('lahans.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 dark:bg-gray-500 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-700 dark:hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Daftar Lahan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>