<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Tanaman: ') . $tanaman->nama }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-3 border-gray-200 dark:border-gray-700">Formulir Edit Tanaman: {{ $tanaman->nama }}</h3>
                    <form action="{{ route('admin.tanaman.update', $tanaman) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- PENTING: Untuk metode UPDATE --}}

                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Tanaman</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" required value="{{ old('nama', $tanaman->nama) }}">
                            @error('nama')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" required>{{ old('deskripsi', $tanaman->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="cara_tanam" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cara Tanam</label>
                            <textarea name="cara_tanam" id="cara_tanam" rows="5" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" required>{{ old('cara_tanam', $tanaman->cara_tanam) }}</textarea>
                            @error('cara_tanam')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar Tanaman</label>
                            @if ($tanaman->gambar)
                                <div class="mb-4"> {{-- Margin bawah lebih besar --}}
                                    <img src="{{ asset('storage/' . $tanaman->gambar) }}" alt="{{ $tanaman->nama }}" class="h-24 w-24 object-cover rounded-md border-2 border-emerald-300 dark:border-emerald-600 shadow-sm"> {{-- Border dan shadow --}}
                                    <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">Gambar saat ini</span>
                                </div>
                            @endif
                            <input type="file" name="gambar" id="gambar" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                                file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 dark:file:bg-emerald-800 dark:file:text-emerald-200
                                hover:file:bg-emerald-100 dark:hover:file:bg-emerald-700 transition duration-150 ease-in-out">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            @error('gambar')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ph_min" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">pH Minimal</label>
                                <input type="number" step="0.1" name="ph_min" id="ph_min" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" min="0" max="14" required value="{{ old('ph_min', $tanaman->ph_min) }}">
                                @error('ph_min')
                                    <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="ph_max" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">pH Maksimal</label>
                                <input type="number" step="0.1" name="ph_max" id="ph_max" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" min="0" max="14" required value="{{ old('ph_max', $tanaman->ph_max) }}">
                                @error('ph_max')
                                    <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="intensitas_sinar_matahari" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Intensitas Sinar Matahari</label>
                            <select name="intensitas_sinar_matahari" id="intensitas_sinar_matahari" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" required>
                                <option value="">Pilih Intensitas</option>
                                <option value="rendah" {{ old('intensitas_sinar_matahari', $tanaman->intensitas_sinar_matahari) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ old('intensitas_sinar_matahari', $tanaman->intensitas_sinar_matahari) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ old('intensitas_sinar_matahari', $tanaman->intensitas_sinar_matahari) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="rendah_sedang" {{ old('intensitas_sinar_matahari', $tanaman->intensitas_sinar_matahari) == 'rendah_sedang' ? 'selected' : '' }}>Rendah - Sedang</option>
                                <option value="sedang_tinggi" {{ old('intensitas_sinar_matahari', $tanaman->intensitas_sinar_matahari) == 'sedang_tinggi' ? 'selected' : '' }}>Sedang - Tinggi</option>
                                <option value="semua" {{ old('intensitas_sinar_matahari', $tanaman->intensitas_sinar_matahari) == 'semua' ? 'selected' : '' }}>Semua</option>
                            </select>
                            @error('intensitas_sinar_matahari')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kelembaban_tanah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelembaban Tanah</label>
                            <select name="kelembaban_tanah" id="kelembaban_tanah" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" required>
                                <option value="">Pilih Kelembaban</option>
                                <option value="rendah" {{ old('kelembaban_tanah', $tanaman->kelembaban_tanah) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ old('kelembaban_tanah', $tanaman->kelembaban_tanah) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ old('kelembaban_tanah', $tanaman->kelembaban_tanah) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="rendah_sedang" {{ old('kelembaban_tanah', $tanaman->kelembaban_tanah) == 'rendah_sedang' ? 'selected' : '' }}>Rendah - Sedang</option>
                                <option value="sedang_tinggi" {{ old('kelembaban_tanah', $tanaman->kelembaban_tanah) == 'sedang_tinggi' ? 'selected' : '' }}>Sedang - Tinggi</option>
                                <option value="semua" {{ old('kelembaban_tanah', $tanaman->kelembaban_tanah) == 'semua' ? 'selected' : '' }}>Semua</option>
                            </select>
                            @error('kelembaban_tanah')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="drainase_tanah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Drainase Tanah</label>
                            <select name="drainase_tanah" id="drainase_tanah" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" required>
                                <option value="">Pilih Drainase</option>
                                <option value="baik" {{ old('drainase_tanah', $tanaman->drainase_tanah) == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="sedang" {{ old('drainase_tanah', $tanaman->drainase_tanah) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="buruk" {{ old('drainase_tanah', $tanaman->drainase_tanah) == 'buruk' ? 'selected' : '' }}>Buruk</option>
                                <option value="baik_sedang" {{ old('drainase_tanah', $tanaman->drainase_tanah) == 'baik_sedang' ? 'selected' : '' }}>Baik - Sedang</option>
                                <option value="semua" {{ old('drainase_tanah', $tanaman->drainase_tanah) == 'semua' ? 'selected' : '' }}>Semua</option>
                            </select>
                            @error('drainase_tanah')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Tanah (pisahkan dengan koma)</label>
                            <input type="text" name="jenis_tanah" id="jenis_tanah" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" placeholder="Contoh: lempung, pasir, liat" required value="{{ old('jenis_tanah', $tanaman->jenis_tanah) }}">
                            @error('jenis_tanah')
                                <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ketinggian_mdpl_min" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ketinggian Min (MDPL)</label>
                                <input type="number" name="ketinggian_mdpl_min" id="ketinggian_mdpl_min" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" value="{{ old('ketinggian_mdpl_min', $tanaman->ketinggian_mdpl_min) }}">
                                @error('ketinggian_mdpl_min')
                                    <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="ketinggian_mdpl_max" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ketinggian Max (MDPL)</label>
                                <input type="number" name="ketinggian_mdpl_max" id="ketinggian_mdpl_max" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-gray-700 dark:text-gray-200" value="{{ old('ketinggian_mdpl_max', $tanaman->ketinggian_mdpl_max) }}">
                                @error('ketinggian_mdpl_max')
                                    <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-3">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Update Tanaman
                            </button>
                            <a href="{{ route('admin.tanaman.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>