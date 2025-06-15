<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Semua Data Lahan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">Semua Data Lahan dari Pengguna</h3>

                    @if ($lahans->isEmpty())
                        <div class="bg-yellow-50 dark:bg-yellow-800/40 border-l-4 border-yellow-400 dark:border-yellow-700 text-yellow-800 dark:text-yellow-300 p-4 rounded-md shadow-sm" role="alert">
                            <p class="font-bold">Belum Ada Data Lahan</p>
                            <p>Saat ini belum ada data lahan yang diinput oleh pengguna.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        {{-- UBAH KELAS DI SETIAP TH INI --}}
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Pengguna</th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Nama Lahan</th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider">pH Tanah</th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Sinar Matahari</th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Tanggal Input</th>
                                        {{-- <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($lahans as $lahan)
                                        <tr class="{{ $loop->even ? 'bg-gray-50 dark:bg-gray-700' : 'bg-white dark:bg-gray-800' }} hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $lahan->user->name ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $lahan->nama_lahan }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $lahan->ph_tanah }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($lahan->intensitas_sinar_matahari) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $lahan->created_at->format('d M Y H:i') }}</td>
                                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 mr-3">Detail</a>
                                                <form action="#" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200" onclick="return confirm('Apakah Anda yakin ingin menghapus data lahan ini?')">Hapus</button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>