<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Lahan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 border-gray-200">Formulir Edit Lahan: {{ $lahan->nama_lahan }}</h3>
                    <form action="{{ route('lahans.update', $lahan) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- PENTING: Untuk metode UPDATE --}}

                        <div>
                            <label for="nama_lahan" class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan</label>
                            <input type="text" name="nama_lahan" id="nama_lahan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required value="{{ old('nama_lahan', $lahan->nama_lahan) }}">
                            @error('nama_lahan')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ph_tanah" class="block text-sm font-medium text-gray-700 mb-1">pH Tanah</label>
                            <input type="number" step="0.1" name="ph_tanah" id="ph_tanah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" min="0" max="14" required value="{{ old('ph_tanah', $lahan->ph_tanah) }}">
                            @error('ph_tanah')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="intensitas_sinar_matahari" class="block text-sm font-medium text-gray-700 mb-1">Intensitas Sinar Matahari</label>
                            <select name="intensitas_sinar_matahari" id="intensitas_sinar_matahari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Pilih Intensitas</option>
                                <option value="rendah" {{ old('intensitas_sinar_matahari', $lahan->intensitas_sinar_matahari) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ old('intensitas_sinar_matahari', $lahan->intensitas_sinar_matahari) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ old('intensitas_sinar_matahari', $lahan->intensitas_sinar_matahari) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                            @error('intensitas_sinar_matahari')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kelembaban_tanah" class="block text-sm font-medium text-gray-700 mb-1">Kelembaban Tanah</label>
                            <select name="kelembaban_tanah" id="kelembaban_tanah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Pilih Kelembaban</option>
                                <option value="rendah" {{ old('kelembaban_tanah', $lahan->kelembaban_tanah) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ old('kelembaban_tanah', $lahan->kelembaban_tanah) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ old('kelembaban_tanah', $lahan->kelembaban_tanah) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                            @error('kelembaban_tanah')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="drainase_tanah" class="block text-sm font-medium text-gray-700 mb-1">Drainase Tanah</label>
                            <select name="drainase_tanah" id="drainase_tanah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Pilih Drainase</option>
                                <option value="baik" {{ old('drainase_tanah', $lahan->drainase_tanah) == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="sedang" {{ old('drainase_tanah', $lahan->drainase_tanah) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="buruk" {{ old('drainase_tanah', $lahan->drainase_tanah) == 'buruk' ? 'selected' : '' }}>Buruk</option>
                            </select>
                            @error('drainase_tanah')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah</label>
                            <input type="text" name="jenis_tanah" id="jenis_tanah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Contoh: lempung, pasir, liat" required value="{{ old('jenis_tanah', $lahan->jenis_tanah) }}">
                            @error('jenis_tanah')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="luas_lahan" class="block text-sm font-medium text-gray-700 mb-1">Luas Lahan (m²)</label>
                            <input type="number" step="0.01" name="luas_lahan" id="luas_lahan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('luas_lahan', $lahan->luas_lahan) }}">
                            @error('luas_lahan')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ketinggian_mdpl" class="block text-sm font-medium text-gray-700 mb-1">Ketinggian (MDPL)</label>
                            <input type="number" name="ketinggian_mdpl" id="ketinggian_mdpl" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('ketinggian_mdpl', $lahan->ketinggian_mdpl) }}">
                            @error('ketinggian_mdpl')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-3">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-700 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Update Data Lahan
                            </button>
                            <a href="{{ route('lahans.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
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