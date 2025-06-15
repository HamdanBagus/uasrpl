<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Hasil Identifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white mb-6 border-b pb-3 border-gray-200 dark:border-gray-700 text-center inline-flex items-center w-full justify-center">
                        <svg class="w-8 h-8 mr-3 text-emerald-500 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.232 9.432a3.375 3.375 0 003.375 3.375H19.5a2.25 2.25 0 002.25-2.25v-2.25m-10.5-5.232V9.75m3-3v3m-9-1.5h.008v.008H3v-.008zM6 15.75h.008v.008H6v-.008zm12 0h.008v.008H18v-.008z" />
                        </svg>
                        Detail Identifikasi: {{ $result->plant_name }}
                    </h3>

                    <div class="text-center mb-8 bg-gray-50 dark:bg-gray-700/30 p-6 rounded-lg shadow-inner border border-gray-200 dark:border-gray-700">
                        @if ($result->uploaded_image_path)
                            <img src="{{ Storage::url($result->uploaded_image_path) }}" alt="Foto yang Anda Unggah" class="mx-auto rounded-lg shadow-lg mb-4 max-h-64 object-cover border-4 border-emerald-400 dark:border-emerald-500 transform hover:scale-105 transition duration-300 ease-in-out">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="Gambar Tidak Tersedia" class="mx-auto rounded-lg shadow-lg mb-4 max-h-64 object-cover border-4 border-gray-400 dark:border-gray-500">
                        @endif

                        <p class="text-lg text-gray-700 dark:text-gray-300 mt-4">Nama Tanaman Teridentifikasi:</p>
                        <p class="text-5xl font-extrabold text-teal-700 dark:text-teal-400 mb-1">{{ $result->plant_name }}</p>
                        <p class="text-2xl font-semibold text-green-600 dark:text-green-400">{{ $result->probability }}% Cocok</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Diidentifikasi pada: {{ $result->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    @if (!empty($result->api_response_details))
                        <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700/30 rounded-lg shadow-inner border border-gray-200 dark:border-gray-700">
                            <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-4 border-b pb-2 border-gray-200 dark:border-gray-600 inline-flex items-center">
                                <svg class="w-6 h-6 mr-2 text-sky-500 dark:text-sky-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                                Detail Tambahan dari Plant.id:
                            </h4>
                            <div class="space-y-4 text-gray-700 dark:text-gray-300 mt-4">
                                @php
                                    // Akses detail dari api_response_details
                                    $details = $result->api_response_details['suggestions'][0]['plant_details'] ?? [];
                                @endphp

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
                                <p class="mt-1">Tidak ada detail tambahan yang tersedia dari API untuk identifikasi ini.</p>
                            </div>
                        </div>
                    @endif

                    <div class="mt-8 flex flex-wrap justify-end gap-3 border-t pt-6 border-gray-200 dark:border-gray-700">
                        <a href="{{ route('identifikasi.history') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Riwayat
                        </a>
                        <a href="{{ route('identifikasi.index') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.867-1.732A2 2 0 0115.07 4h1.86a2 2 0 012 2v6m-3-3h.01M16 12a2 2 0 01-2 2H5a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2h-2zm-2-4h.01"></path></svg>
                            Identifikasi Foto Lain
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>