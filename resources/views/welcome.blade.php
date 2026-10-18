@php
$paketPernikahan = $paket['pernikahan'] ?? null;
$paketSeminar = $paket['seminar'] ?? null;
$paketPerpisahan = $paket['perpisahan'] ?? null;
$setting = fn ($key, $fallback = '') => $pengaturan[$key] ?? $fallback;
$whatsappUrl = 'https://wa.me/' . preg_replace('/\D+/', '', $setting('whatsapp_nomor', '6281234567890'));
$judulHero = $setting('hero_judul', 'Hall Unilam - Universitas La Tansa Mashiro');
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Unilam - Universitas La Tansa Mashiro</title>
    <link rel="icon" href="{{ asset('images/logo-HallUnilam.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Bricolage Grotesque"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Hero: slideshow dengan zoom pelan */
        @keyframes hero-slideshow {

            0%,
            16% {
                opacity: .5;
                transform: scale(1.12);
            }

            20%,
            96% {
                opacity: 0;
                transform: scale(1);
            }

            100% {
                opacity: .5;
                transform: scale(1.12);
            }
        }

        .hero-slide {
            animation: hero-slideshow 24s linear infinite;
        }

        .hero-delay-0 {
            animation-delay: 0s;
        }

        .hero-delay-1 {
            animation-delay: -4s;
        }

        .hero-delay-2 {
            animation-delay: -8s;
        }

        .hero-delay-3 {
            animation-delay: -12s;
        }

        .hero-delay-4 {
            animation-delay: -16s;
        }

        .hero-delay-5 {
            animation-delay: -20s;
        }

        /* Hero: satu rangkaian animasi saat halaman dibuka */
        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @keyframes word-in {
            from {
                opacity: 0;
                transform: translateY(70%) rotate(3deg);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .rise {
            opacity: 0;
            animation: rise .8s cubic-bezier(.2, .7, .2, 1) forwards;
        }

        .word {
            display: inline-block;
            opacity: 0;
            animation: word-in .7s cubic-bezier(.2, .7, .2, 1) forwards;
        }

        /* Cahaya melayang di hero */
        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, -40px);
            }
        }

        .orb {
            animation: float 14s ease-in-out infinite;
        }

        /* Muncul saat di-scroll */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .7s ease, transform .7s cubic-bezier(.2, .7, .2, 1);
            transition-delay: var(--d, 0s);
        }

        .reveal.in {
            opacity: 1;
            transform: none;
        }

        .glass-panel {
            background: rgba(255, 255, 255, .82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .site-header {
            background: rgba(255, 255, 255, .7);
            backdrop-filter: blur(18px) saturate(140%);
            -webkit-backdrop-filter: blur(18px) saturate(140%);
            border-color: rgba(204, 251, 241, .6);
            transition: all .3s;
        }

        .site-header.is-scrolled {
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 12px 30px rgba(15, 118, 110, .14);
        }

        .instagram-brand {
            background: linear-gradient(45deg, #feda75 0%, #fa7e1e 25%, #d62976 50%, #962fbf 75%, #4f5bd5 100%);
        }

        /* Tombol: kilau saat di-hover */
        .shine {
            position: relative;
            overflow: hidden;
        }

        .shine::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, .45) 50%, transparent 70%);
            transform: translateX(-120%);
            transition: transform .7s;
        }

        .shine:hover::after {
            transform: translateX(120%);
        }

        /* Kartu: naik pelan saat di-hover */
        .lift {
            transition: transform .3s cubic-bezier(.2, .7, .2, 1), box-shadow .3s, background-color .3s;
        }

        .lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 36px rgba(15, 118, 110, .16);
        }

        /* Tombol WhatsApp melayang */
        @keyframes ping-soft {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, .55);
            }

            100% {
                box-shadow: 0 0 0 20px rgba(37, 211, 102, 0);
            }
        }

        .wa-pulse {
            animation: ping-soft 2.2s infinite;
        }

        .table-wrap {
            scrollbar-width: thin;
            scrollbar-color: #14b8a6 transparent;
        }

        th.sticky-col,
        td.sticky-col {
            position: sticky;
            left: 0;
            z-index: 1;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid rgba(20, 184, 166, .7);
            outline-offset: 3px;
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }

            .rise,
            .word,
            .reveal {
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
</head>

<body class="bg-teal-50 text-teal-950 font-sans antialiased selection:bg-teal-600 selection:text-white"
    x-data="{ lightbox: null, menu: false, top: false, section: 'hero' }"
    @scroll.window.passive="top = window.scrollY > 500"
    @keydown.escape.window="lightbox = null; menu = false">

    <!-- Progress scroll -->
    <div id="progress" class="fixed top-0 left-0 h-1 w-full origin-left scale-x-0 bg-gradient-to-r from-teal-400 to-emerald-400 z-[60]"></div>

    <!-- Header -->
    <header x-data="{ scrolled: false }" @scroll.window.passive="scrolled = window.scrollY > 24" :class="{ 'is-scrolled': scrolled }" class="site-header fixed top-0 left-0 right-0 z-50 border-b">
        <div class="max-w-7xl mx-auto px-5 md:px-6 flex justify-between items-center transition-all duration-300" :class="scrolled ? 'py-2' : 'py-3'">
            <a href="#hero" class="flex items-center gap-3 group">
                <div class="w-12 h-12 md:w-14 md:h-14 bg-white p-1.5 rounded-full shadow-lg shadow-teal-900/15 flex items-center justify-center transition-all duration-300 group-hover:rotate-[360deg] duration-700" :class="scrolled ? 'scale-90' : ''">
                    <img src="{{ asset('images/logo-HallUnilam.png') }}" alt="Logo Hall Unilam" class="w-full h-full object-contain rounded-full">
                </div>
                <div>
                    <span class="font-display font-extrabold text-base md:text-lg tracking-wide text-teal-950 block leading-none">{{ $setting('brand_nama', 'HALL UNILAM') }}</span>
                    <span class="text-[10px] text-teal-600 font-bold tracking-widest uppercase hidden sm:block">{{ $setting('brand_subtitle', 'UNIVERSITAS LA TANSA MASHIRO') }}</span>
                </div>
            </a>

            <nav class="hidden md:flex gap-1 text-xs font-bold text-teal-800">
                @foreach([['hero','Beranda'],['about','Tentang'],['paket','Daftar Harga & Paket'],['galeri','Galeri'],['kontak','Kontak & Reservasi']] as [$id,$label])
                <a href="#{{ $id }}" :class="section === '{{ $id }}' ? 'bg-teal-600 text-white shadow-md shadow-teal-600/25' : 'hover:bg-teal-100'" class="px-4 py-2 rounded-full transition-all duration-300">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ $whatsappUrl . '?text=' . urlencode($setting('whatsapp_pesan', 'Halo, saya ingin reservasi La Tansa Hall Unilam')) }}" target="_blank"
                    class="shine bg-teal-700 hover:bg-teal-800 text-white text-xs px-4 md:px-5 py-2.5 rounded-full font-bold transition shadow-md shadow-teal-800/25 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-check"></i> <span class="hidden sm:inline">Reservasi Now</span><span class="sm:hidden">Reservasi</span>
                </a>
                @auth
                <a href="{{ route('admin.dashboard') }}" class="hidden sm:block bg-teal-600 hover:bg-teal-700 text-white text-xs px-4 py-2.5 rounded-full font-bold transition"><i class="fa-solid fa-gauge"></i> Admin</a>
                @else
                <a href="{{ route('login') }}" class="hidden sm:block bg-white hover:bg-teal-100 text-teal-800 border border-teal-200 text-xs px-4 py-2.5 rounded-full font-bold transition"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                @endauth
                <button @click="menu = !menu" class="md:hidden w-10 h-10 rounded-full bg-white border border-teal-200 text-teal-800 flex items-center justify-center" aria-label="Buka menu">
                    <i class="fa-solid" :class="menu ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        <!-- Menu mobile -->
        <div x-cloak x-show="menu" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-3" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-y-3"
            class="md:hidden px-5 pb-4 flex flex-col gap-1 text-sm font-bold text-teal-800" @click="menu = false">
            <a href="#hero" class="px-4 py-2.5 rounded-xl hover:bg-teal-100">Beranda</a>
            <a href="#about" class="px-4 py-2.5 rounded-xl hover:bg-teal-100">Tentang</a>
            <a href="#paket" class="px-4 py-2.5 rounded-xl hover:bg-teal-100">Daftar Harga & Paket</a>
            <a href="#galeri" class="px-4 py-2.5 rounded-xl hover:bg-teal-100">Galeri</a>
            <a href="#kontak" class="px-4 py-2.5 rounded-xl hover:bg-teal-100">Kontak & Reservasi</a>
        </div>
    </header>

    <!-- Hero -->
    <section id="hero" data-spy class="relative pt-32 pb-24 px-6 bg-teal-900 overflow-hidden min-h-[78vh] flex items-center justify-center">
        @foreach($heroMedia as $index => $slide)
        <img src="{{ $slide->publicUrl() }}" alt="{{ $slide->alt }}" class="absolute inset-0 w-full h-full object-cover hero-slide hero-delay-{{ min($index, 5) }}">
        @endforeach
        <div class="absolute inset-0 bg-gradient-to-b from-teal-900/80 via-teal-800/55 to-teal-900"></div>
        <div class="orb absolute -top-20 -left-20 w-80 h-80 rounded-full bg-teal-400/20 blur-3xl"></div>
        <div class="orb absolute bottom-0 -right-16 w-96 h-96 rounded-full bg-emerald-300/15 blur-3xl" style="animation-delay:-6s"></div>

        <div class="relative z-10 text-center max-w-4xl mx-auto">
            <span class="rise text-xs font-bold text-teal-100 bg-teal-900/70 border border-teal-200/50 px-4 py-1.5 rounded-full inline-flex items-center gap-2 mb-6 backdrop-blur" style="animation-delay:.1s">
                <i class="fa-solid fa-location-dot text-teal-300"></i> {{ $setting('hero_lokasi', 'Rangkasbitung, Banten') }}
            </span>
            <h1 class="font-display text-4xl md:text-6xl font-extrabold text-white leading-[1.05] mb-5 tracking-tight">
                @foreach(explode(' ', $judulHero) as $i => $w)
                <span class="overflow-hidden inline-block align-bottom"><span class="word" style="animation-delay: {{ .25 + $i * .08 }}s">{{ $w }}&nbsp;</span></span>
                @endforeach
            </h1>
            <p class="rise text-teal-50/90 text-sm md:text-lg mb-9 max-w-2xl mx-auto leading-relaxed" style="animation-delay:.9s">
                {{ $setting('hero_deskripsi', 'Panggung serbaguna dengan kapasitas 1.500-2.500 untuk Pernikahan, Seminar, Konser, Gathering, dan Perpisahan Sekolah.') }}
            </p>
            <div class="rise flex flex-wrap gap-3 justify-center" style="animation-delay:1.1s">
                <a href="#paket" class="shine bg-teal-400 hover:bg-teal-300 text-teal-950 text-sm px-7 py-3.5 rounded-full font-bold transition shadow-lg shadow-teal-400/30 hover:-translate-y-0.5">
                    {{ $setting('hero_tombol', 'Lihat Katalog Paket Pricing') }}
                </a>
                <a href="#kontak" class="text-white text-sm px-7 py-3.5 rounded-full font-bold border border-white/40 hover:bg-white/10 transition">Cek tanggal tersedia</a>
            </div>
        </div>

        <a href="#about" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-teal-100/70 text-xs flex flex-col items-center gap-2" aria-label="Scroll ke bawah">
            <span class="w-6 h-10 rounded-full border-2 border-teal-100/50 flex justify-center pt-2"><span class="w-1 h-2 bg-teal-100 rounded-full animate-bounce"></span></span>
        </a>
    </section>

    <!-- Tentang -->
    <section id="about" data-spy class="scroll-mt-20 pt-20 pb-16 bg-teal-50 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="reveal glass-panel p-8 md:p-12 rounded-3xl border border-teal-100 shadow-xl shadow-teal-900/5 -mt-32 relative z-10">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 bg-white rounded-full p-1 shadow-md shadow-teal-900/10 shrink-0">
                        <img src="{{ asset('images/logo-HallUnilam.png') }}" alt="Logo Hall Unilam" class="w-full h-full object-contain rounded-full">
                    </div>
                    <h2 class="font-display text-2xl md:text-3xl font-extrabold text-teal-950">{{ $about->judul ?? 'Tentang La Tansa Hall' }}</h2>
                </div>
                <p class="text-teal-900/80 leading-relaxed md:text-lg max-w-3xl">
                    {{ $about->konten ?? 'La Tansa Hall hadir di Rangkasbitung dengan fasilitas serbaguna untuk berbagai jenis acara.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Paket -->
    <main id="paket" data-spy class="scroll-mt-20 py-16 px-4 md:px-8 max-w-7xl mx-auto space-y-10">

        @php
        $weddingItems = $paketPernikahan?->items->groupBy('nama_item') ?? collect();
        $weddingHeaders = $paketPernikahan?->items->pluck('tipe')->filter()->unique()->values() ?? collect();
        @endphp

        <!-- I. Pernikahan -->
        <div class="reveal glass-panel rounded-3xl p-6 md:p-8 shadow-xl shadow-teal-900/5 border border-teal-100">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-11 h-11 bg-teal-600 text-white rounded-2xl flex items-center justify-center text-lg shadow-lg shadow-teal-600/25">
                    <i class="fa-solid fa-building-columns" aria-hidden="true"></i>
                </div>
                <div>
                    <h2 class="font-display text-xl md:text-2xl font-extrabold text-teal-950 uppercase tracking-tight">{{ $paketPernikahan->nama_paket ?? 'PAKET PERNIKAHAN' }}</h2>
                    <p class="text-xs text-teal-700/70 font-medium">{{ $paketPernikahan->waktu ?? '' }}</p>
                </div>
            </div>

            <div class="table-wrap overflow-x-auto rounded-2xl border border-teal-100 shadow-sm">
                <table class="w-full text-left text-xs md:text-sm">
                    <thead class="bg-teal-800 text-white">
                        <tr>
                            <th class="sticky-col bg-teal-800 p-4 font-bold text-teal-100 min-w-[180px]">Fasilitas / Uraian</th>
                            @foreach($weddingHeaders as $header)
                            <th class="p-4 text-center font-bold whitespace-nowrap">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-teal-50 text-teal-900/80 font-medium">
                        @forelse($weddingItems as $name => $row)
                        <tr class="group odd:bg-white even:bg-teal-50/60 hover:bg-teal-100/70 transition-colors">
                            <td class="sticky-col p-4 font-bold text-teal-950 bg-inherit group-odd:bg-white group-even:bg-teal-50 group-hover:bg-teal-100 transition-colors">{{ $name }}</td>
                            @foreach($weddingHeaders as $header)
                            <td class="p-4 text-center">{{ $row->firstWhere('tipe', $header)?->nilai ?? '-' }}</td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ $weddingHeaders->count() + 1 }}" class="p-6 text-center text-teal-700/60">Belum ada item paket.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p class="md:hidden text-[11px] text-teal-700/60 mt-3"><i class="fa-solid fa-arrows-left-right"></i> Geser tabel untuk melihat semua paket</p>
        </div>

        <!-- II & III -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="reveal lift glass-panel rounded-3xl p-6 md:p-8 shadow-xl shadow-teal-900/5 border border-teal-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-11 h-11 bg-teal-700 text-white rounded-2xl flex items-center justify-center text-lg shadow-lg shadow-teal-700/25">
                            <i class="fa-solid fa-chalkboard-user" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-lg md:text-xl font-extrabold text-teal-950 uppercase">{{ $paketSeminar->nama_paket ?? 'PAKET SEMINAR' }}</h3>
                            <p class="text-[11px] text-teal-700/70 font-medium">{{ $paketSeminar->waktu ?? '' }}</p>
                        </div>
                    </div>
                    <div class="space-y-1 pt-4 border-t border-teal-100 text-sm">
                        @forelse($paketSeminar?->items ?? [] as $item)
                        <div class="flex justify-between items-center gap-4 py-2 px-2 -mx-2 rounded-lg border-b border-teal-50 hover:bg-teal-50 transition-colors">
                            <span class="font-semibold text-teal-900">{{ $item->nama_item }}</span>
                            <span class="font-extrabold text-teal-950 text-right">{{ $item->nilai }}</span>
                        </div>
                        @empty
                        <p class="text-xs text-teal-700/60">Belum ada item paket.</p>
                        @endforelse
                    </div>
                </div>
                @if(!empty($paketSeminar->catatan))
                <div class="mt-6 p-3 bg-teal-50 rounded-xl border border-teal-200 text-xs text-teal-900 flex items-start gap-2">
                    <i class="fa-solid fa-circle-info text-teal-600 mt-0.5"></i>
                    <span>{{ $paketSeminar->catatan }}</span>
                </div>
                @endif
            </div>

            <div class="reveal lift glass-panel rounded-3xl p-6 md:p-8 shadow-xl shadow-teal-900/5 border border-teal-100 flex flex-col justify-between" style="--d:.12s">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-11 h-11 bg-emerald-500 text-teal-950 rounded-2xl flex items-center justify-center text-lg shadow-lg shadow-emerald-500/25">
                            <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-lg md:text-xl font-extrabold text-teal-950 uppercase">{{ $paketPerpisahan->nama_paket ?? 'PAKET PERPISAHAN SEKOLAH' }}</h3>
                            <p class="text-[11px] text-teal-700/70 font-medium">Waktu Acara: {{ $paketPerpisahan->waktu ?? '' }}</p>
                        </div>
                    </div>
                    <div class="space-y-1 pt-4 border-t border-teal-100 text-sm">
                        @forelse($paketPerpisahan?->items ?? [] as $item)
                        <div class="flex justify-between items-center gap-4 py-2 px-2 -mx-2 rounded-lg border-b border-teal-50 hover:bg-teal-50 transition-colors">
                            <span class="font-semibold text-teal-900">{{ $item->nama_item }}</span>
                            <span class="font-extrabold text-teal-950 text-right">{{ $item->nilai }}</span>
                        </div>
                        @empty
                        <p class="text-xs text-teal-700/60">Belum ada item paket.</p>
                        @endforelse
                    </div>
                </div>
                <a href="{{ $whatsappUrl . '?text=' . urlencode('Halo ' . $setting('whatsapp_nama', 'Admin') . ', saya ingin sewa ' . ($paketPerpisahan->nama_paket ?? 'Paket Perpisahan')) }}" target="_blank"
                    class="shine mt-6 w-full text-center py-3 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition shadow-lg shadow-teal-600/25">
                    <i class="fa-brands fa-whatsapp"></i> Pesan Paket Perpisahan
                </a>
            </div>
        </div>

        <!-- IV. Fasilitas -->
        <div class="reveal glass-panel rounded-3xl p-6 md:p-8 shadow-xl shadow-teal-900/5 border border-teal-100">
            <div class="flex items-center gap-3 mb-6">
                <i class="fa-solid fa-list-check text-teal-600 text-xl"></i>
                <h3 class="font-display text-xl font-extrabold text-teal-950">Sewa Sarana & Peralatan Satuan ({{ date('Y') }})</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($fasilitas as $i => $item)
                <div class="reveal lift bg-teal-50/80 p-5 rounded-2xl border border-teal-100 flex flex-col justify-between hover:bg-teal-100/70" style="--d: {{ min($i % 3, 2) * .08 }}s">
                    <div>
                        <span class="text-sm text-teal-900 font-semibold block">{{ $item->nama_fasilitas }}</span>
                        <span class="text-[11px] text-teal-600 font-semibold">Tersedia: {{ $item->stok }} Unit</span>
                    </div>
                    <p class="font-display text-xl font-extrabold text-teal-950 mt-3">
                        Rp {{ number_format($item->harga, 0, ',', '.') }} <span class="text-xs font-semibold text-teal-700/60 font-sans">/ unit</span>
                    </p>
                </div>
                @empty
                <div class="col-span-full text-center py-6 text-teal-700/60 text-xs">Belum ada data fasilitas yang ditambahkan di admin.</div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Galeri -->
    <section id="galeri" data-spy class="scroll-mt-20 py-16 bg-white border-t border-teal-100 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="reveal text-center mb-10">
                <h2 class="font-display text-2xl md:text-4xl font-extrabold text-teal-950">{{ $setting('galeri_judul', 'Galeri Real Venue La Tansa Hall') }}</h2>
                <p class="text-sm text-teal-800/70 mt-2">{{ $setting('galeri_deskripsi', 'Dokumentasi nyata tampilan gedung interior dan exterior') }}</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                @forelse($galeriMedia as $i => $media)
                <button type="button" @click="lightbox = { src: '{{ $media->publicUrl() }}', alt: @js($media->alt), caption: @js($media->caption) }"
                    class="reveal group relative overflow-hidden rounded-2xl border border-teal-100 aspect-video shadow-lg shadow-teal-900/10 text-left" style="--d: {{ min($i % 3, 2) * .1 }}s">
                    <img src="{{ $media->publicUrl() }}" alt="{{ $media->alt }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <span class="absolute inset-0 bg-gradient-to-t from-teal-950/70 via-transparent opacity-0 group-hover:opacity-100 transition duration-300"></span>
                    <span class="absolute top-3 right-3 w-9 h-9 rounded-full bg-white/90 text-teal-800 flex items-center justify-center opacity-0 scale-75 group-hover:opacity-100 group-hover:scale-100 transition duration-300"><i class="fa-solid fa-expand text-xs"></i></span>
                    @if($media->caption)
                    <span class="absolute bottom-3 left-3 bg-teal-950/85 text-teal-50 text-[11px] px-3 py-1 rounded-full font-bold backdrop-blur-sm translate-y-2 group-hover:translate-y-0 transition duration-300">{{ $media->caption }}</span>
                    @endif
                </button>
                @empty
                <p class="col-span-full text-center py-6 text-teal-700/60 text-xs">Belum ada gambar galeri.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" data-spy class="relative scroll-mt-20 py-20 bg-teal-900 text-white px-6 overflow-hidden">
        <div class="orb absolute -top-24 right-0 w-96 h-96 rounded-full bg-teal-400/15 blur-3xl"></div>
        <div class="relative max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <div class="reveal bg-teal-800/80 p-8 md:p-10 rounded-3xl border border-teal-500/50 shadow-xl shadow-teal-950/25 backdrop-blur-md">
                <span class="text-xs font-bold text-teal-300 block mb-2">Kontak reservasi & sewa</span>
                <h3 class="font-display text-2xl md:text-3xl font-extrabold text-white mb-4">{{ $setting('kontak_judul', 'Pemesanan Venue Official') }}</h3>
                <p class="text-teal-100/80 text-sm mb-7 leading-relaxed">
                    {{ $setting('kontak_deskripsi', 'Untuk cek ketersediaan tanggal acara, survei lokasi, dan reservasi gedung, silakan hubungi penanggung jawab resmi:') }}
                </p>
                <a href="{{ $whatsappUrl . '?text=' . urlencode($setting('whatsapp_pesan', 'Halo, saya ingin sewa La Tansa Hall Unilam')) }}" target="_blank"
                    class="shine group flex items-center gap-4 bg-teal-400 hover:bg-teal-300 text-teal-950 p-4 rounded-2xl font-bold transition shadow-lg shadow-teal-400/30">
                    <div class="w-12 h-12 bg-[#25D366] text-white rounded-xl flex items-center justify-center text-2xl wa-pulse"><i class="fa-brands fa-whatsapp"></i></div>
                    <div class="flex-1">
                        <span class="text-xs text-teal-950/70 block font-normal">Penanggung Jawab Sewa Hall</span>
                        <span class="text-base font-extrabold">{{ $setting('whatsapp_nama', 'WhatsApp Official') }}</span>
                    </div>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                </a>
            </div>

            <div class="space-y-3">
                <div class="reveal">
                    <h3 class="font-display text-xl font-extrabold text-white mb-1">Media Sosial Resmi</h3>
                    <p class="text-teal-100/70 text-sm mb-3">Ikuti kanal resmi kami untuk dokumentasi event, info kampus, dan kabar terbaru.</p>
                </div>
                @foreach([
                ['key' => 'instagram_hall', 'icon' => 'fa-instagram', 'title' => 'Instagram Hall', 'description' => 'Akun Instagram Resmi La Tansa Hall', 'color' => ''],
                ['key' => 'instagram_unilam', 'icon' => 'fa-instagram', 'title' => 'Instagram UNILAM', 'description' => 'Instagram Resmi Universitas La Tansa Mashiro', 'color' => ''],
                ['key' => 'facebook_url', 'icon' => 'fa-facebook-f', 'title' => 'Facebook', 'description' => 'Halaman Facebook resmi Hall Unilam', 'color' => 'bg-gradient-to-tr from-teal-700 to-teal-400'],
                ['key' => 'tiktok_url', 'icon' => 'fa-tiktok', 'title' => 'TikTok', 'description' => 'Video dan kabar terbaru Hall Unilam', 'color' => 'bg-gradient-to-tr from-teal-950 to-teal-500'],
                ['key' => 'youtube_url', 'icon' => 'fa-youtube', 'title' => 'YouTube', 'description' => 'Video dokumentasi dan informasi venue', 'color' => 'bg-gradient-to-tr from-emerald-700 to-teal-400'],
                ] as $n => $social)
                @if($setting($social['key']))
                <a href="{{ $setting($social['key']) }}" target="_blank" rel="noopener noreferrer"
                    class="reveal group flex items-center justify-between bg-teal-800/70 hover:bg-teal-700 hover:translate-x-1 border border-teal-500/50 p-4 rounded-2xl transition backdrop-blur-sm" style="--d: {{ $n * .07 }}s">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 {{ $social['icon'] === 'fa-instagram' ? 'instagram-brand' : $social['color'] }} rounded-2xl ring-2 ring-teal-200/40 shadow-lg shadow-teal-950/20 flex items-center justify-center text-white text-2xl group-hover:scale-110 group-hover:-rotate-6 transition">
                            <i class="fa-brands {{ $social['icon'] }}" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">{{ $social['title'] }}</h4>
                            <p class="text-xs text-teal-100/70">{{ $social['description'] }}</p>
                        </div>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-teal-200/60 group-hover:text-white transition"></i>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-teal-950 border-t border-teal-700 py-6 text-center text-xs text-teal-200/70 px-6">
        <p>&copy; {{ date('Y') }} {{ $setting('footer_teks', 'Universitas La Tansa Mashiro (UNILAM) - La Tansa Hall. All rights reserved.') }}</p>
    </footer>

    <!-- WhatsApp melayang + kembali ke atas -->
    <div class="fixed bottom-5 right-5 z-40 flex flex-col items-center gap-3">
        <a href="#hero" x-cloak x-show="top" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition duration-200" x-transition:leave-end="opacity-0 translate-y-4"
            class="w-11 h-11 rounded-full bg-white text-teal-800 border border-teal-200 shadow-lg flex items-center justify-center hover:bg-teal-100" aria-label="Kembali ke atas"><i class="fa-solid fa-chevron-up"></i></a>
        <a href="{{ $whatsappUrl . '?text=' . urlencode($setting('whatsapp_pesan', 'Halo, saya ingin sewa La Tansa Hall Unilam')) }}" target="_blank"
            class="wa-pulse w-14 h-14 rounded-full bg-[#25D366] text-white text-3xl shadow-xl flex items-center justify-center hover:scale-110 transition" aria-label="Chat WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
    </div>

    <!-- Lightbox galeri -->
    <div x-cloak x-show="lightbox" @click="lightbox = null" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-200" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[70] bg-teal-950/90 backdrop-blur-sm flex items-center justify-center p-4">
        <figure class="max-w-5xl w-full" @click.stop x-transition:enter="transition duration-300" x-transition:enter-start="scale-95">
            <img :src="lightbox?.src" :alt="lightbox?.alt" class="w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl">
            <figcaption x-show="lightbox?.caption" x-text="lightbox?.caption" class="text-center text-teal-100 text-sm mt-3"></figcaption>
        </figure>
        <button class="absolute top-5 right-5 w-11 h-11 rounded-full bg-white/15 hover:bg-white/30 text-white" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <script>
        // Muncul saat di-scroll
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in');
                    io.unobserve(e.target);
                }
            });
        }, {
            threshold: .12,
            rootMargin: '0px 0px -40px 0px'
        });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));

        // Menu aktif sesuai bagian yang sedang dilihat
        const spy = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) document.body._x_dataStack[0].section = e.target.id;
            });
        }, {
            rootMargin: '-45% 0px -50% 0px'
        });
        document.querySelectorAll('[data-spy]').forEach(el => spy.observe(el));

        // Bar progres scroll
        const bar = document.getElementById('progress');
        addEventListener('scroll', () => {
            const h = document.documentElement;
            bar.style.transform = `scaleX(${h.scrollTop / (h.scrollHeight - h.clientHeight || 1)})`;
        }, {
            passive: true
        });
    </script>
</body>

</html>