<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Katalog Tanaman Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 dark:from-gray-800 dark:via-gray-900 dark:to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-800/40 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded relative mb-6 shadow-md" role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Tanaman Katalog</h3>
                        <a href="{{ route('admin.tanaman.create') }}" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Tanaman Baru
                        </a>
                    </div>

                    @if ($tanaman->isEmpty())
                        <div class="bg-yellow-50 dark:bg-yellow-800/40 border-l-4 border-yellow-400 dark:border-yellow-700 text-yellow-800 dark:text-yellow-300 p-4 rounded-md shadow-sm" role="alert">
                            <p class="font-bold">Belum Ada Data Tanaman</p>
                            <p>Silakan tambahkan data tanaman ke katalog Anda.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Gambar</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nama Tanaman</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">pH Ideal</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Sinar Matahari</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($tanaman as $item)
                                        <tr class="{{ $loop->even ? 'bg-gray-50 dark:bg-gray-700' : 'bg-white dark:bg-gray-800' }} hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($item->gambar)
                                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="h-16 w-16 object-cover rounded-full border-2 border-emerald-200 dark:border-emerald-600 shadow-sm">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="h-16 w-16 object-cover rounded-full border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item->nama }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $item->ph_min }} - {{ $item->ph_max }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ ucfirst(str_replace('_', ' ', $item->intensitas_sinar_matahari)) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.tanaman.show', $item) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 mr-3 transition duration-150 ease-in-out">Detail</a>
                                                <a href="{{ route('admin.tanaman.edit', $item) }}" class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-200 mr-3 transition duration-150 ease-in-out">Edit</a>
                                                <form action="{{ route('admin.tanaman.destroy', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 transition duration-150 ease-in-out" onclick="return confirm('Apakah Anda yakin ingin menghapus tanaman ini?')">Hapus</button>
                                                </form>
                                            </td>
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