<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logoWeb.png') }}" alt="Logo Aplikasi" class="block" style="height: 50px; width: 50px;">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"> <!--dekstop -->
                    @auth {{-- Jika pengguna sudah login --}}
                        @if (Auth::user()->role === 'admin') {{-- Jika peran adalah Admin --}}
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Dashboard Admin') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.tanaman.index')" :active="request()->routeIs('admin.tanaman.index') || request()->routeIs('admin.tanaman.create') || request()->routeIs('admin.tanaman.edit') || request()->routeIs('admin.tanaman.show')">
                                {{ __('Katalog Tanaman') }}
                            </x-nav-link>
                        @else {{-- Jika peran adalah User Biasa --}}
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('lahans.index')" :active="request()->routeIs('lahans.index') || request()->routeIs('lahans.create') || request()->routeIs('lahans.edit') || request()->routeIs('lahans.show')">
                                {{ __('Data Lahan Saya') }}
                            </x-nav-link>
                            <x-nav-link :href="route('chatbot.index')" :active="request()->routeIs('chatbot.index')">
                                {{ __('Chatbot') }}
                            </x-nav-link>
                            <x-nav-link :href="route('katalog.index')" :active="request()->routeIs('katalog.index') || request()->routeIs('katalog.show')"> {{-- TAMBAHKAN INI --}}
                                {{ __('Katalog Tanaman') }}
                            </x-nav-link>
                            <x-nav-link :href="route('identifikasi.index')" :active="request()->routeIs('identifikasi.index') || request()->routeIs('identifikasi.identify')"> {{-- TAMBAHKAN INI --}}
                                {{ __('Identifikasi Tanaman') }}
                            </x-nav-link>
                            <x-nav-link :href="route('identifikasi.history')" :active="request()->routeIs('identifikasi.history') || request()->routeIs('identifikasi.history_detail')"> {{-- TAMBAHKAN INI --}}
                                {{ __('Riwayat Identifikasi') }}
                            </x-nav-link>
                        @endif
                    @else {{-- Jika pengguna belum login (Guest) --}}
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('katalog.index')" :active="request()->routeIs('katalog.index') || request()->routeIs('katalog.show')"> {{-- TAMBAHKAN INI --}}
                            {{ __('Katalog Tanaman') }}
                        </x-nav-link>
                        {{-- Tambahkan link lain untuk guest di sini jika diperlukan, contoh:
                        <x-nav-link :href="route('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        --}}
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Hapus bagian ini jika ada:
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            --}}
        </div>
        <div class="mt-3 space-y-1">
            @auth {{-- Jika pengguna sudah login --}}
                @if (Auth::user()->role === 'admin') {{-- Jika peran adalah Admin --}}
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard Admin') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.tanaman.index')" :active="request()->routeIs('admin.tanaman.index') || request()->routeIs('admin.tanaman.create') || request()->routeIs('admin.tanaman.edit') || request()->routeIs('admin.tanaman.show')">
                        {{ __('Katalog Tanaman') }}
                    </x-responsive-nav-link>
                @else {{-- Jika peran adalah User Biasa --}}
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('lahans.index')" :active="request()->routeIs('lahans.index') || request()->routeIs('lahans.create') || request()->routeIs('lahans.edit') || request()->routeIs('lahans.show')">
                        {{ __('Data Lahan Saya') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('katalog.index')" :active="request()->routeIs('katalog.index') || request()->routeIs('katalog.show')"> {{-- TAMBAHKAN INI --}}
                        {{ __('Katalog Tanaman') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('chatbot.index')" :active="request()->routeIs('chatbot.index')">
                        {{ __('Chatbot') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('identifikasi.index')" :active="request()->routeIs('identifikasi.index') || request()->routeIs('identifikasi.identify')"> {{-- TAMBAHKAN INI --}}
                        {{ __('Identifikasi Tanaman') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('identifikasi.history')" :active="request()->routeIs('identifikasi.history') || request()->routeIs('identifikasi.history_detail')"> {{-- TAMBAHKAN INI --}}
                        {{ __('Riwayat Identifikasi') }}
                    </x-responsive-nav-link>
                @endif
            @else {{-- Jika pengguna belum login (Guest) --}}
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('katalog.index')" :active="request()->routeIs('katalog.index') || request()->routeIs('katalog.show')"> {{-- TAMBAHKAN INI --}}
                    {{ __('Katalog Tanaman') }}
                </x-responsive-nav-link>
                {{-- Tambahkan link lain untuk guest di sini jika diperlukan --}}
            @endauth
        </div>

        {{-- Hapus div ini karena isinya sudah dipindahkan/dihapus di atas:
        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('lahans.index')" :active="request()->routeIs('lahans.index')">
                {{ __('Data Lahan Saya') }}
            </x-responsive-nav-link>
        </div>
        --}}

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>