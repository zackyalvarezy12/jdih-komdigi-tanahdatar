<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — JDIH Kabupaten Tanah Datar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex">

    {{-- LEFT PANEL --}}
    <div class="hidden lg:flex lg:w-5/12 bg-red-900 flex-col justify-center items-center relative overflow-hidden px-12 py-16">

        <div class="absolute inset-0 bg-gradient-to-br from-red-950 via-red-900 to-red-800"></div>
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full bg-yellow-500 opacity-5 -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full bg-yellow-400 opacity-5 translate-y-1/2 -translate-x-1/2"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 rounded-full border border-yellow-500/10 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 rounded-full border border-yellow-500/10 -translate-x-1/2 -translate-y-1/2"></div>

        <div class="relative z-10 text-center">
            <div class="w-28 h-28 rounded-full border-2 border-yellow-500/40 flex items-center justify-center mx-auto mb-8 bg-white/5 shadow-2xl">
                <div class="w-20 h-20 rounded-full bg-red-800/60 flex items-center justify-center">
                    {{-- Ganti dengan: <img src="{{ asset('images/logo-tanah-datar.png') }}" class="w-14 h-14 object-contain" alt="Logo"> --}}
                    <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                    </svg>
                </div>
            </div>

            <p class="text-xs font-semibold tracking-widest uppercase text-yellow-500/70 mb-3">
                Pemerintah Kabupaten Tanah Datar
            </p>
            <h1 class="text-3xl font-bold text-yellow-300 leading-tight mb-3">
                Jaringan Dokumentasi<br>dan Informasi Hukum
            </h1>

            <div class="flex items-center justify-center gap-3 my-5">
                <div class="h-px w-10 bg-gradient-to-r from-transparent to-yellow-500/50"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-yellow-500/60"></div>
                <div class="h-px w-10 bg-gradient-to-l from-transparent to-yellow-500/50"></div>
            </div>

            <p class="text-sm text-white/40 leading-relaxed italic font-light">
                Buat akun administrator baru<br>untuk mengelola dokumentasi<br>hukum daerah
            </p>

            {{-- Steps indicator --}}
            <div class="mt-10 space-y-3">
                <div class="flex items-center gap-3 text-left">
                    <div class="w-6 h-6 rounded-full bg-yellow-500/20 border border-yellow-500/40 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-white/50">Isi data identitas akun</span>
                </div>
                <div class="flex items-center gap-3 text-left">
                    <div class="w-6 h-6 rounded-full bg-yellow-500/20 border border-yellow-500/40 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-white/50">Buat kata sandi yang kuat</span>
                </div>
                <div class="flex items-center gap-3 text-left">
                    <div class="w-6 h-6 rounded-full bg-yellow-500/20 border border-yellow-500/40 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-white/50">Akun siap digunakan</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-0 right-0 flex justify-center gap-1">
            <div class="w-8 h-0.5 bg-yellow-500/30 rounded-full"></div>
            <div class="w-2 h-0.5 bg-yellow-500/20 rounded-full"></div>
            <div class="w-2 h-0.5 bg-yellow-500/20 rounded-full"></div>
        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="flex-1 flex flex-col justify-center items-center bg-stone-50 px-8 py-12 relative overflow-y-auto">

        <div class="hidden lg:block absolute left-0 top-1/4 bottom-1/4 w-px bg-gradient-to-b from-transparent via-yellow-500/40 to-transparent"></div>

        {{-- Mobile logo --}}
        <div class="lg:hidden flex flex-col items-center mb-8">
            <div class="w-16 h-16 rounded-full bg-red-900 flex items-center justify-center mb-3">
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold tracking-widest uppercase text-red-900/70">JDIH Tanah Datar</p>
        </div>

        <div class="w-full max-w-sm">
            <p class="text-xs font-semibold tracking-widest uppercase text-yellow-600 mb-2">Pendaftaran Akun</p>
            <h2 class="text-3xl font-bold text-stone-800 mb-1">Buat Akun Baru</h2>
            <p class="text-sm text-stone-400 font-light mb-8">Lengkapi data berikut untuk mendaftarkan akun administrator.</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-xs font-semibold tracking-wider uppercase text-stone-500 mb-2">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input
                            id="name" type="text" name="name"
                            value="{{ old('name') }}"
                            placeholder="Nama lengkap Anda"
                            required autofocus autocomplete="name"
                            class="w-full pl-10 pr-4 py-3 bg-white border border-stone-200 rounded-xl text-sm text-stone-800 placeholder-stone-300 focus:outline-none focus:ring-2 focus:ring-yellow-500/30 focus:border-yellow-500 transition {{ $errors->has('name') ? 'border-red-400' : '' }}"
                        />
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold tracking-wider uppercase text-stone-500 mb-2">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input
                            id="email" type="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@tandatar.go.id"
                            required autocomplete="username"
                            class="w-full pl-10 pr-4 py-3 bg-white border border-stone-200 rounded-xl text-sm text-stone-800 placeholder-stone-300 focus:outline-none focus:ring-2 focus:ring-yellow-500/30 focus:border-yellow-500 transition {{ $errors->has('email') ? 'border-red-400' : '' }}"
                        />
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold tracking-wider uppercase text-stone-500 mb-2">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input
                            id="password" type="password" name="password"
                            placeholder="Min. 8 karakter"
                            required autocomplete="new-password"
                            class="w-full pl-10 pr-4 py-3 bg-white border border-stone-200 rounded-xl text-sm text-stone-800 placeholder-stone-300 focus:outline-none focus:ring-2 focus:ring-yellow-500/30 focus:border-yellow-500 transition {{ $errors->has('password') ? 'border-red-400' : '' }}"
                        />
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold tracking-wider uppercase text-stone-500 mb-2">
                        Konfirmasi Kata Sandi
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <input
                            id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Ulangi kata sandi"
                            required autocomplete="new-password"
                            class="w-full pl-10 pr-4 py-3 bg-white border border-stone-200 rounded-xl text-sm text-stone-800 placeholder-stone-300 focus:outline-none focus:ring-2 focus:ring-yellow-500/30 focus:border-yellow-500 transition {{ $errors->has('password_confirmation') ? 'border-red-400' : '' }}"
                        />
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-red-900 hover:bg-red-800 active:scale-95 text-white text-sm font-semibold py-3.5 rounded-xl transition-all shadow-lg shadow-red-900/25 hover:shadow-red-900/40 mt-2">
                    Daftarkan Akun
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>

            </form>

            {{-- Already registered --}}
            <div class="mt-6 text-center">
                <p class="text-sm text-stone-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-red-800 font-medium hover:text-red-700 transition ml-1">
                        Masuk di sini
                    </a>
                </p>
            </div>

            <div class="mt-6 pt-6 border-t border-stone-200 text-center">
                <p class="text-xs text-stone-400">
                    &copy; {{ date('Y') }} JDIH Kabupaten Tanah Datar &mdash; Hak cipta dilindungi
                </p>
            </div>
        </div>
    </div>

</body>
</html>