<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - La Tansa Hall Unilam</title>
    <link rel="icon" href="{{ asset('images/logo-HallUnilam.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,800&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Latar: foto gedung dengan zoom pelan */
        .login-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            background: #064e4a;
        }

        .login-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url('/images/halamanDepanHall.jpeg') center / cover no-repeat;
            animation: kenburns 28s ease-in-out infinite alternate;
        }

        .login-bg::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(1, 55, 52, .78), rgba(4, 91, 84, .45));
        }

        @keyframes kenburns {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.12) translate(-1.5%, -1%);
            }
        }

        /* Cahaya melayang */
        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(35px, -45px);
            }
        }

        .orb {
            animation: float 14s ease-in-out infinite;
        }

        /* Kartu */
        .login-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, .2), rgba(4, 65, 61, .3));
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, .5);
            box-shadow: 0 30px 70px rgba(0, 45, 42, .35), inset 0 1px 0 rgba(255, 255, 255, .42);
        }

        /* Satu rangkaian animasi saat halaman dibuka */
        @keyframes card-in {
            from {
                opacity: 0;
                transform: translateY(40px) scale(.96);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @keyframes logo-in {
            from {
                opacity: 0;
                transform: scale(.4) rotate(-120deg);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .card-in {
            animation: card-in .8s cubic-bezier(.2, .7, .2, 1) both;
        }

        .rise {
            opacity: 0;
            animation: rise .6s cubic-bezier(.2, .7, .2, 1) forwards;
            animation-delay: var(--d, 0s);
        }

        .logo-in {
            animation: logo-in .9s cubic-bezier(.2, .8, .2, 1) .25s both;
        }

        /* Cincin berdenyut di sekitar logo */
        @keyframes ring {
            0% {
                transform: scale(1);
                opacity: .55;
            }

            100% {
                transform: scale(1.55);
                opacity: 0;
            }
        }

        .logo-ring::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            border: 2px solid rgba(110, 231, 183, .8);
            animation: ring 2.6s ease-out 1.2s infinite;
        }

        /* Input */
        .login-glass-control {
            background: rgba(2, 44, 44, .25);
            border: 1px solid rgba(209, 250, 229, .32);
            transition: background .25s, border-color .25s;
        }

        .login-glass-control:focus {
            background: rgba(4, 66, 63, .5);
        }

        .login-field {
            transition: box-shadow .25s, transform .25s;
        }

        .login-field:focus-within {
            box-shadow: 0 0 0 3px rgba(45, 212, 191, .2), 0 12px 28px rgba(0, 0, 0, .18);
            transform: translateY(-2px);
        }

        .login-field .field-icon {
            transition: color .25s, transform .25s;
        }

        .login-field:focus-within .field-icon {
            color: #6ee7b7;
            transform: scale(1.15);
        }

        input:-webkit-autofill {
            -webkit-text-fill-color: #fff;
            transition: background-color 9999s;
        }

        /* Error: bergetar sekali */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-8px);
            }

            40%,
            80% {
                transform: translateX(8px);
            }
        }

        .shake {
            animation: shake .5s ease both;
        }

        /* Tombol: kilau + loading */
        .shine {
            position: relative;
            overflow: hidden;
        }

        .shine::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, .5) 50%, transparent 70%);
            transform: translateX(-120%);
            transition: transform .7s;
        }

        .shine:hover::after {
            transform: translateX(120%);
        }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid rgba(110, 231, 183, .7);
            outline-offset: 3px;
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }

            .rise {
                opacity: 1 !important;
            }
        }
    </style>
</head>

<body class="text-emerald-50 flex items-center justify-center min-h-screen p-4 font-sans antialiased relative overflow-hidden">

    <!-- Latar -->
    <div class="login-bg" aria-hidden="true"></div>
    <div class="orb fixed -top-24 -left-24 w-96 h-96 rounded-full bg-teal-400/25 blur-3xl z-[1]" aria-hidden="true"></div>
    <div class="orb fixed -bottom-32 -right-24 w-[28rem] h-[28rem] rounded-full bg-emerald-300/20 blur-3xl z-[1]" style="animation-delay:-7s" aria-hidden="true"></div>

    <div class="login-card card-in w-full max-w-sm rounded-3xl p-7 md:p-9 relative z-10">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="logo-in relative inline-block mb-5">
                <div class="logo-ring relative inline-flex items-center justify-center w-24 h-24 bg-white/90 p-2 rounded-full shadow-xl shadow-black/25">
                    <img src="{{ asset('images/logo-HallUnilam.png') }}" alt="Logo Hall Unilam" class="w-full h-full object-contain rounded-full">
                </div>
            </div>
            <h1 class="rise font-display text-3xl font-extrabold text-white tracking-tight" style="--d:.55s">Login Admin</h1>
            <p class="rise text-sm text-emerald-100/90 mt-2" style="--d:.65s">Selamat datang kembali. Masuk untuk mengelola La Tansa Hall.</p>
        </div>

        <!-- Pesan error -->
        @if ($errors->any())
        <div role="alert" class="shake mb-6 p-3.5 text-xs rounded-2xl flex items-center gap-2.5 backdrop-blur-sm bg-rose-900/30 border border-rose-200/40 text-rose-100">
            <i class="fa-solid fa-circle-exclamation text-rose-300 text-sm shrink-0"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-5"
            x-data="{ showPassword: false, caps: false, loading: false }" @submit="loading = true">
            @csrf

            <div class="rise" style="--d:.75s">
                <label for="email" class="block text-xs font-semibold text-white/90 mb-2">Alamat email</label>
                <div class="login-field relative rounded-xl">
                    <span class="field-icon absolute inset-y-0 left-0 flex items-center pl-3.5 text-emerald-300/80"><i class="fa-regular fa-envelope text-sm"></i></span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="login-glass-control w-full pl-11 pr-4 py-3.5 text-sm rounded-xl text-white placeholder-emerald-100/45 focus:outline-none focus:border-emerald-300"
                        placeholder="admin@gmail.com">
                </div>
            </div>

            <div class="rise" style="--d:.85s">
                <label for="password" class="block text-xs font-semibold text-white/90 mb-2">Kata sandi</label>
                <div class="login-field relative rounded-xl">
                    <span class="field-icon absolute inset-y-0 left-0 flex items-center pl-3.5 text-emerald-300/80"><i class="fa-solid fa-lock text-sm"></i></span>
                    <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password"
                        @keyup="caps = $event.getModifierState && $event.getModifierState('CapsLock')" @blur="caps = false"
                        class="login-glass-control w-full pl-11 pr-11 py-3.5 text-sm rounded-xl text-white placeholder-emerald-100/45 focus:outline-none focus:border-emerald-300"
                        placeholder="••••••••">
                    <button type="button" @click="showPassword = !showPassword" :aria-label="showPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-emerald-100/60 hover:text-emerald-300 transition">
                        <i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
                <p x-cloak x-show="caps" x-transition.opacity class="mt-2 text-[11px] text-amber-200 flex items-center gap-1.5">
                    <i class="fa-solid fa-triangle-exclamation"></i> Caps Lock sedang aktif
                </p>
            </div>

            <div class="rise flex items-center text-xs" style="--d:.95s">
                <label class="flex items-center cursor-pointer text-emerald-100/80 hover:text-white transition select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-emerald-200/50 bg-emerald-950/40 text-emerald-500 focus:ring-emerald-400">
                    <span class="ml-2">Ingat saya di perangkat ini</span>
                </label>
            </div>

            <div class="rise" style="--d:1.05s">
                <button type="submit" :disabled="loading" :class="loading ? 'opacity-80 cursor-wait' : 'hover:-translate-y-0.5 hover:bg-emerald-400'"
                    class="shine w-full py-3.5 bg-emerald-500 text-emerald-950 font-extrabold rounded-xl shadow-lg shadow-emerald-500/30 transition duration-200 text-sm flex items-center justify-center gap-2">
                    <i x-cloak x-show="loading" class="fa-solid fa-circle-notch fa-spin"></i>
                    <span x-text="loading ? 'Memproses...' : 'Masuk sekarang'">Masuk sekarang</span>
                </button>
            </div>
        </form>

        <!-- Kembali -->
        <div class="rise mt-8 text-center pt-5 border-t border-emerald-200/20" style="--d:1.15s">
            <a href="{{ route('beranda') }}" class="group inline-flex items-center gap-2 text-xs text-emerald-100/75 hover:text-emerald-300 font-medium transition">
                <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1"></i> Kembali ke halaman utama
            </a>
        </div>
    </div>
</body>

</html>