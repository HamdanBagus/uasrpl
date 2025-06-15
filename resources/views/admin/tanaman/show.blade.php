<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Tanaman: ') . $tanaman->nama }}
        </h2>
    </x-slot>

    {{-- Latar belakang utama dengan gradient yang sesuai tema admin --}}
    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama untuk konten --}}
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    {{-- Gambar Tanaman & Nama --}}
                    <div class="mb-8 text-center">
                        @if ($tanaman->gambar)
                            <div class="w-80 h-80 mx-auto rounded-lg shadow-lg border-4 border-white dark:border-gray-700 overflow-hidden">
                                <img src="{{ asset('storage/' . $tanaman->gambar) }}" alt="{{ $tanaman->nama }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-80 h-80 bg-gray-200 dark:bg-gray-700 rounded-lg shadow-lg flex items-center justify-center mx-auto border-4 border-white dark:border-gray-700">
                                <svg class="w-24 h-24 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        @endif
                        <h1 class="mt-6 text-3xl lg:text-4xl font-extrabold text-gray-800 dark:text-white">{{ $tanaman->nama }}</h1>
                    </div>

                    {{-- Spesifikasi Tanaman --}}
                    <div class="mb-8 p-6 bg-emerald-50 dark:bg-emerald-800/30 rounded-xl shadow-lg border border-emerald-200 dark:border-emerald-700">
                        <h3 class="text-xl font-semibold text-emerald-700 dark:text-emerald-300 mb-4 inline-flex items-center">
                            <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            Spesifikasi Ideal Tanaman
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @php
                                $details = [
                                    'pH Ideal' => ($tanaman->ph_min && $tanaman->ph_max) ? $tanaman->ph_min . ' - ' . $tanaman->ph_max : '-',
                                    'Sinar Matahari' => ucfirst(str_replace('_', ' ', $tanaman->intensitas_sinar_matahari)),
                                    'Kelembaban Tanah' => ucfirst(str_replace('_', ' ', $tanaman->kelembaban_tanah)),
                                    'Drainase Tanah' => ucfirst(str_replace('_', ' ', $tanaman->drainase_tanah)),
                                    'Jenis Tanah' => $tanaman->jenis_tanah,
                                    'Ketinggian (MDPL)' => ($tanaman->ketinggian_mdpl_min && $tanaman->ketinggian_mdpl_max) ? $tanaman->ketinggian_mdpl_min . ' - ' . $tanaman->ketinggian_mdpl_max : ($tanaman->ketinggian_mdpl_min ?? ($tanaman->ketinggian_mdpl_max ?? '-')),
                                ];
                            @endphp

                            @foreach ($details as $label => $value)
                            <div class="bg-white dark:bg-emerald-700/40 p-3 rounded-lg shadow-sm border border-emerald-100 dark:border-emerald-600">
                                <p class="text-xs font-medium text-emerald-600 dark:text-emerald-400">{{ $label }}:</p>
                                <p class="mt-0.5 text-base font-semibold text-gray-700 dark:text-gray-100">{{ $value }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2 inline-flex items-center">
                            <svg class="w-6 h-6 mr-2 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                            Deskripsi
                        </h3>
                        <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400 leading-relaxed">
                            {!! nl2br(e($tanaman->deskripsi)) !!}
                        </div>
                    </div>

                    {{-- Cara Tanam --}}
                    @if ($tanaman->cara_tanam)
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2 inline-flex items-center">
                             <svg class="w-6 h-6 mr-2 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Cara Tanam
                        </h3>
                        <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400 leading-relaxed">
                           {!! nl2br(e($tanaman->cara_tanam)) !!}
                        </div>
                    </div>
                    @endif

                    {{-- Tombol Aksi Admin --}}
                    <div class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-700 text-center sm:text-right flex flex-wrap justify-end gap-3">
                        <a href="{{ route('admin.tanaman.edit', $tanaman) }}" class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Tanaman
                        </a>
                        <form action="{{ route('admin.tanaman.destroy', $tanaman) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105" onclick="return confirm('Apakah Anda yakin ingin menghapus tanaman ini?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus Tanaman
                            </button>
                        </form>
                        <a href="{{ route('admin.tanaman.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>