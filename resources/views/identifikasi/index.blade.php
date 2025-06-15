<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Identifikasi Tanaman dari Foto') }}
        </h2>
    </x-slot>

    {{-- Latar belakang utama dengan gradient yang sesuai tema --}}
    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black min-h-[calc(100vh-4rem)]">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama untuk konten --}}
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white mb-6 border-b pb-3 border-gray-200 dark:border-gray-700 text-center inline-flex items-center w-full justify-center">
                        <svg class="w-8 h-8 mr-3 text-emerald-500 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15.5a2.25 2.25 0 002.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.105 2.105 0 00-1.664-1.055 48.305 48.305 0 00-4.134 0 2.105 2.105 0 00-1.664 1.055l-.822 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                        Unggah Foto Tanaman Anda
                    </h3>

                    {{-- Pesan Error --}}
                    @if (session('error'))
                        <div class="bg-red-50 dark:bg-red-700/30 border-l-4 border-red-500 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded-r-lg shadow-md mb-6 flex items-center" role="alert">
                            <svg class="w-6 h-6 mr-3 text-red-500 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <div>
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('identifikasi.identify') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 cursor-pointer hover:border-emerald-500 dark:hover:border-emerald-400 transition duration-150 ease-in-out bg-gray-50 dark:bg-gray-700/30"> {{-- Desain area upload --}}
                            <label for="plant_image" class="text-gray-600 dark:text-gray-300 mb-3 text-lg font-medium hover:text-emerald-600 dark:hover:text-emerald-400">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15.5a2.25 2.25 0 002.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.105 2.105 0 00-1.664-1.055 48.305 48.305 0 00-4.134 0 2.105 2.105 0 00-1.664 1.055l-.822 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                </svg>
                                Pilih atau Seret Gambar di Sini
                            </label>
                            <input type="file" name="plant_image" id="plant_image" accept="image/*" class="hidden">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Ukuran maksimal: 5MB (JPG, PNG, GIF)</p>
                            <img id="image-preview" src="#" alt="Pratinjau Gambar" class="mt-6 max-h-56 rounded-lg shadow-md border-2 border-gray-200 dark:border-gray-600 hidden">
                        </div>
                        @error('plant_image')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 text-center font-medium">{{ $message }}</p>
                        @enderror

                        <div class="flex items-center justify-center mt-6">
                            <button type="submit" class="inline-flex items-center px-8 py-4 bg-emerald-600 border border-transparent rounded-lg font-semibold text-base text-white uppercase tracking-wider shadow-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.867-1.732A2 2 0 0115.07 4h1.86a2 2 0 012 2v6m-3-3h.01M16 12a2 2 0 01-2 2H5a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2h-2zm-2-4h.01"></path></svg>
                                Identifikasi Tanaman Ini
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('plant_image').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('image-preview');
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        });
    </script>
    @endpush
</x-app-layout>