<nav class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-10">
        <div class="h-16 flex items-center justify-between relative">

            <div class="shrink-0">
                <a href="/" class="text-2xl font-extrabold text-blue-600">
                    KosMas
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-8 absolute left-1/2 transform -translate-x-1/2">
                <a href="/" class="font-medium transition {{ request()->is('/') ? 'text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600' }}">
                    Home
                </a>

                <a href="{{ route('daftarkamar') }}" class="font-medium transition {{ request()->routeIs('daftarkamar') || request()->is('daftar-kamar*') ? 'text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600' }}">
                    Kamar
                </a>

                {{-- Riwayat hanya muncul jika penghuni sudah login --}}
                @auth('penghuni')
                    <a href="{{ route('riwayat') }}" class="font-medium transition {{ request()->is('riwayat*') ? 'text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600' }}">
                        Riwayat
                    </a>
                @endauth
            </div>

            <div class="hidden lg:flex items-center gap-3 shrink-0">
                @auth('penghuni')
                    {{-- Tampilan jika SUDAH login --}}
                    <span class="text-sm text-slate-500 mr-1">
                        Halo, {{ Auth::guard('penghuni')->user()['nama'] }}
                    </span>

                    <!-- MANTAP! DI SINI TEMPAT UNTUK VERSI DESKTOP -->
                    <a href="{{ route('profil') }}" class="flex items-center gap-2.5 px-3 py-1.5 border rounded-xl hover:bg-slate-50 transition text-sm font-medium {{ request()->routeIs('profil') ? 'border-blue-600 bg-blue-50/40 text-blue-600' : 'border-slate-200 text-slate-700' }}">
                        @if(Auth::guard('penghuni')->user()->foto_profil)
                            <img src="{{ asset('storage/' . Auth::guard('penghuni')->user()->foto_profil) }}" alt="Avatar" class="w-6 h-6 rounded-full object-cover">
                        @else
                            <div class="w-6 h-6 bg-blue-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center uppercase">
                                {{ substr(Auth::guard('penghuni')->user()->nama, 0, 2) }}
                            </div>
                        @endif
                        <span>Profil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition text-sm font-medium">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest('penghuni')
                    {{-- Tampilan jika BELUM login --}}
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 border rounded-xl hover:bg-slate-100 transition text-sm font-medium text-slate-700">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition text-sm font-medium">
                        Daftar
                    </a>
                @endguest
            </div>

            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white shadow-md">
        <div class="px-4 py-4 space-y-3">
            <a href="/" class="block py-2 {{ request()->is('/') ? 'text-blue-600 font-semibold' : 'text-slate-700 hover:text-blue-600' }}">
                Home
            </a>

            <a href="{{ route('daftarkamar') }}" class="block py-2 {{ request()->routeIs('daftarkamar') || request()->is('daftar-kamar*') ? 'text-blue-600 font-semibold' : 'text-slate-700 hover:text-blue-600' }}">
                Kamar
            </a>

            @auth('penghuni')
                <a href="{{ route('riwayat') }}" class="block py-2 {{ request()->is('riwayat*') ? 'text-blue-600 font-semibold' : 'text-slate-700 hover:text-blue-600' }}">
                    Riwayat
                </a>
                <hr class="my-2">
                <div class="text-sm text-slate-500 mb-2 font-medium">
                    Halo, {{ Auth::guard('penghuni')->user()['nama'] }}
                </div>

                <!-- DI SINI JUGA KITA PASANG UNTUK VERSI MOBILE BIAR SINKRON -->
                <a href="{{ route('profil') }}" class="flex items-center justify-center gap-2.5 w-full py-2.5 border rounded-lg hover:bg-slate-50 transition text-sm font-medium {{ request()->routeIs('profil') ? 'border-blue-600 bg-blue-50/40 text-blue-600' : 'border-slate-200 text-slate-700' }}">
                    @if(Auth::guard('penghuni')->user()->foto_profil)
                        <img src="{{ asset('storage/' . Auth::guard('penghuni')->user()->foto_profil) }}" alt="Avatar" class="w-6 h-6 rounded-full object-cover">
                    @else
                        <div class="w-6 h-6 bg-blue-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center uppercase">
                            {{ substr(Auth::guard('penghuni')->user()->nama, 0, 2) }}
                        </div>
                    @endif
                    <span>Profil</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full mt-2 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                        Logout
                    </button>
                </form>
            @endauth

            @guest('penghuni')
                <hr class="my-2">
                <a href="{{ route('login') }}"
                    class="block w-full text-center py-2 border rounded-lg hover:bg-slate-100 transition text-sm font-medium text-slate-700">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="block w-full text-center py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium mt-2">
                    Daftar
                </a>
            @endguest
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
    });
</script>