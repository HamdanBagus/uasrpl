<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Identifikasi Tanaman') }}
        </h2>
    </x-slot>

    {{-- Latar belakang utama dengan gradient yang sesuai tema --}}
    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama untuk konten --}}
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white mb-6 border-b pb-3 border-gray-200 dark:border-gray-700 text-center inline-flex items-center w-full justify-center">
                        <svg class="w-8 h-8 mr-3 text-emerald-500 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L18.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.455L14.25 6l1.035-.259a3.375 3.375 0 002.455-2.455L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.455L21.75 6l-1.035.259a3.375 3.375 0 00-2.455 2.455z" />
                        </svg>
                        Hasil Identifikasi
                    </h3>

                    <div class="text-center mb-8 bg-gray-50 dark:bg-gray-700/30 p-6 rounded-lg shadow-inner border border-gray-200 dark:border-gray-700">
                        {{-- Tampilkan gambar yang diunggah user --}}
                        @if ($userUploadedImageUrl)
                            <img src="{{ $userUploadedImageUrl }}" alt="Foto yang Anda Unggah" class="mx-auto rounded-lg shadow-lg mb-4 max-h-64 object-cover border-4 border-emerald-400 dark:border-emerald-500 transform hover:scale-105 transition duration-300 ease-in-out">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="Gambar Tidak Tersedia" class="mx-auto rounded-lg shadow-lg mb-4 max-h-64 object-cover border-4 border-gray-400 dark:border-gray-500">
                        @endif

                        <p class="text-lg text-gray-700 dark:text-gray-300 mt-4">Kemungkinan Terbesar:</p>
                        <p class="text-5xl font-extrabold text-teal-700 dark:text-teal-400 mb-1">{{ $plantName }}</p>
                        <p class="text-2xl font-semibold text-green-600 dark:text-green-400">{{ $probability }}% Cocok</p>
                    </div>

                    @if (!empty($details))
                        <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700/30 rounded-lg shadow-inner border border-gray-200 dark:border-gray-700">
                            <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-4 border-b pb-2 border-gray-200 dark:border-gray-600 inline-flex items-center">
                                <svg class="w-6 h-6 mr-2 text-sky-500 dark:text-sky-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                                Detail Tanaman (Plant.id):
                            </h4>
                            <div class="space-y-4 text-gray-700 dark:text-gray-300 mt-4">
                                @if (isset($details['common_names']) && !empty($details['common_names']))
                                    <p><strong class="text-gray-900 dark:text-white">Nama Umum:</strong> {{ implode(', ', $details['common_names']) }}</p>
                                @endif
                                @if (isset($details['taxonomy']) && !empty($details['taxonomy']))
                                    <p><strong class="text-gray-900 dark:text-white">Taksonomi:</strong></p>
                                    <ul class="list-disc list-inside ml-4 text-base space-y-1">
                                        @foreach ($details['taxonomy'] as $key => $value)
                                            @if ($value) <li><span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span> {{ $value }}</li> @endif
                                        @endforeach
                                    </ul>
                                @endif
                                @if (isset($details['description']) && !empty($details['description']['value']))
                                    <p><strong class="text-gray-900 dark:text-white">Deskripsi:</strong> {{ $details['description']['value'] }}</p>
                                @endif
                                @if (isset($details['wiki_url']))
                                    <p><strong class="text-gray-900 dark:text-white">Info Lebih Lanjut:</strong> <a href="{{ $details['wiki_url'] }}" target="_blank" class="text-sky-500 hover:text-sky-700 dark:text-sky-400 dark:hover:text-sky-300 underline">{{ $details['wiki_url'] }}</a></p>
                                @endif

                                @if (isset($details['edible_parts']) && !empty($details['edible_parts']))
                                    <p><strong class="text-gray-900 dark:text-white">Bagian yang Bisa Dimakan:</strong> {{ implode(', ', $details['edible_parts']) }}</p>
                                @endif
                                @if (isset($details['watering']) && !empty($details['watering']['min_frequency']) && !empty($details['watering']['max_frequency']))
                                    <p><strong class="text-gray-900 dark:text-white">Penyiraman Ideal:</strong> {{ $details['watering']['min_frequency'] }} - {{ $details['watering']['max_frequency'] }} kali/minggu</p>
                                @endif
                                @if (isset($details['watering']) && !empty($details['watering']['soil']))
                                    <p><strong class="text-gray-900 dark:text-white">Tanah Ideal:</strong> {{ $details['watering']['soil'] }}</p>
                                @endif
                                @if (isset($details['sun_exposure']) && !empty($details['sun_exposure']))
                                    <p><strong class="text-gray-900 dark:text-white">Paparan Sinar Matahari:</strong> {{ implode(', ', $details['sun_exposure']) }}</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="bg-amber-50 dark:bg-amber-700/30 border-l-4 border-amber-500 dark:border-amber-600 text-amber-700 dark:text-amber-300 p-6 rounded-r-lg shadow-md flex items-center" role="alert">
                            <svg class="w-6 h-6 mr-3 text-amber-500 dark:text-amber-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <div>
                                <p class="font-bold">Info!</p>
                                <p class="mt-1">Tidak ada detail tambahan yang tersedia dari API untuk tanaman ini.</p>
                            </div>
                        </div>
                    @endif

                    <div class="mt-8 text-center border-t pt-6 border-gray-200 dark:border-gray-700">
                        <a href="{{ route('identifikasi.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Identifikasi Foto Lain
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>