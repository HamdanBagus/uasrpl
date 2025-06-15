<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Lahan: ') . $lahan->nama_lahan }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 border-gray-200">Informasi Lengkap Lahan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        {{-- Card untuk setiap detail --}}
                        @php
                            $details = [
                                'Nama Lahan' => $lahan->nama_lahan,
                                'pH Tanah' => $lahan->ph_tanah,
                                'Intensitas Sinar Matahari' => ucfirst($lahan->intensitas_sinar_matahari),
                                'Kelembaban Tanah' => ucfirst($lahan->kelembaban_tanah),
                                'Drainase Tanah' => ucfirst($lahan->drainase_tanah),
                                'Jenis Tanah' => $lahan->jenis_tanah,
                                'Luas Lahan' => ($lahan->luas_lahan ? $lahan->luas_lahan . ' m²' : '-'),
                                'Ketinggian (MDPL)' => ($lahan->ketinggian_mdpl ?? '-'),
                            ];
                        @endphp

                        @foreach ($details as $label => $value)
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
                                <p class="text-sm font-medium text-gray-600 mb-1">{{ $label }}:</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex flex-wrap justify-end gap-3 border-t pt-6 border-gray-200">
                        <a href="{{ route('lahans.edit', $lahan) }}" class="inline-flex items-center px-6 py-3 bg-yellow-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Lahan
                        </a>
                        <form action="{{ route('lahans.destroy', $lahan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus data lahan ini?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus Lahan
                            </button>
                        </form>
                        <a href="{{ route('lahans.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-500 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                        <a href="{{ route('rekomendasi.show', $lahan) }}" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Dapatkan Rekomendasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>