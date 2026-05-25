<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel Desa Cantik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex overflow-hidden">

{{-- ============================================================ --}}
{{-- LEFT PANEL — Green                                            --}}
{{-- ============================================================ --}}
<div class="relative w-[43%] min-h-screen bg-green-900 flex flex-col justify-center px-16 py-12 overflow-hidden flex-shrink-0">

    {{-- Grid overlay --}}
    <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(to right, rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,1) 1px, transparent 1px); background-size: 40px 40px;"></div>

    {{-- Decorative circles --}}
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-green-700 opacity-30"></div>
    <div class="absolute bottom-[-120px] right-[-120px] w-[500px] h-[500px] rounded-full bg-green-700 opacity-20"></div>
    <div class="absolute top-28 right-10 w-40 h-40 rounded-full bg-green-200 opacity-10"></div>

    {{-- Content --}}
    <div class="relative z-10">
        {{-- Logo --}}
        <div class="flex items-center gap-3 mb-16">
            <div class="w-10 h-10 rounded-xl bg-green-700 border border-green-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
            </div>
            <div>
                <p class="text-white text-sm font-bold leading-none">Desa Cantik</p>
                <p class="text-green-400 text-xs">Admin Panel</p>
            </div>
        </div>

        {{-- Headline --}}
        <h1 class="text-white text-5xl font-bold leading-tight">Portal Data</h1>
        <h2 class="text-green-300 text-5xl font-bold leading-tight mt-1">Desa Cantik</h2>

        <p class="text-green-200 text-base mt-8 leading-relaxed">
            Kelola data desa dengan mudah:<br>
            statistik, peta, infografis, dan publikasi.
        </p>

        {{-- Feature list --}}
        <div class="mt-10 space-y-4">
            @foreach([
                'Dashboard statistik & chart interaktif',
                'Upload & kelola infografis',
                'Manajemen peta spasial GPS',
                'Publikasi dokumen PDF',
                'Pengaturan konten situs',
            ] as $feature)
            <div class="flex items-center gap-3">
                <span class="text-green-400 text-sm">✅</span>
                <span class="text-green-200 text-xs">{{ $feature }}</span>
            </div>
            @endforeach
        </div>

        {{-- Divider --}}
        <div class="mt-16 h-px bg-white opacity-20"></div>

        {{-- Back link --}}
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mt-6 text-green-300 text-xs hover:text-white transition-colors">
            ← Kembali ke portal publik
        </a>
    </div>
</div>

{{-- ============================================================ --}}
{{-- RIGHT PANEL — White                                           --}}
{{-- ============================================================ --}}
<div class="flex-1 bg-white flex items-center justify-center relative overflow-hidden px-8 py-12">

    {{-- Decorative circles top-right --}}
    <div class="absolute -top-10 -right-10 w-60 h-60 rounded-full bg-green-100 opacity-40 pointer-events-none"></div>
    <div class="absolute top-5 right-5 w-28 h-28 rounded-full bg-green-200 opacity-30 pointer-events-none"></div>

    {{-- Login Card --}}
    <div class="relative z-10 w-full max-w-lg bg-white border border-gray-200 rounded-2xl shadow-sm px-10 py-10">

        {{-- Header --}}
        <div class="text-center mb-6">
            <h2 class="text-gray-900 text-3xl font-bold">Selamat Datang</h2>
            <p class="text-gray-500 text-sm mt-2">Masuk ke Admin Panel Desa Cantik</p>
        </div>

        <div class="border-t border-gray-100 mb-6"></div>

        {{-- FORM --}}
        <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-5">

            {{-- Error message (hidden by default) --}}
            <div id="errorBox" class="hidden bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-red-600 text-xs">
                Email atau kata sandi salah. Silakan coba lagi.
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-gray-700 text-xs font-bold mb-2" for="email">Alamat Email</label>
                <div class="relative">
                    <input
                        id="email"
                        type="email"
                        placeholder="admin@desa.go.id"
                        autocomplete="email"
                        class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 pr-10 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white transition-colors"
                    >
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-base pointer-events-none">✉</span>
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-gray-700 text-xs font-bold mb-2" for="password">Kata Sandi</label>
                <div class="relative">
                    <input
                        id="password"
                        type="password"
                        placeholder="••••••••••••"
                        autocomplete="current-password"
                        class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 pr-10 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white transition-colors"
                    >
                    <button type="button" id="togglePass" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors text-base">
                        👁
                    </button>
                </div>
            </div>

            {{-- Remember me + Forgot password --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <div class="relative">
                        <input id="remember" type="checkbox" class="sr-only peer">
                        <div class="w-4 h-4 bg-gray-200 peer-checked:bg-green-700 rounded transition-colors flex items-center justify-center">
                            <svg class="w-2.5 h-2.5 text-white hidden peer-checked:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-gray-700 text-xs">Ingat saya</span>
                </label>
                <a href="#" class="text-green-700 text-xs hover:underline">Lupa kata sandi?</a>
            </div>

            {{-- Submit button --}}
            <button
                id="submitBtn"
                type="submit"
                class="w-full bg-green-700 text-white text-base font-bold py-3 rounded-lg hover:bg-green-800 active:bg-green-900 transition-colors flex items-center justify-center gap-2 mt-2"
            >
                <span id="btnText">Masuk ke Dashboard</span>
                <svg id="btnSpinner" class="hidden w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </button>

        </form>

        {{-- Divider --}}
        <div class="flex items-center gap-4 my-6">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="text-gray-400 text-xs">atau</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- Info box --}}
        <div class="bg-green-50 rounded-lg px-4 py-3 flex items-start gap-3">
            <span class="text-base mt-0.5 flex-shrink-0">🔒</span>
            <div>
                <p class="text-green-700 text-xs font-medium">Area terbatas — hanya untuk admin desa</p>
                <p class="text-gray-500 text-xs mt-0.5">Hubungi sekdes jika lupa password.</p>
            </div>
        </div>

        {{-- Footer --}}
        <p class="text-gray-400 text-xs text-center mt-8">Portal Data Desa Cantik</p>

    </div>
</div>

<script>
function togglePassword() {
    const pass = document.getElementById('password');
    const icon = document.getElementById('togglePass');
    if (pass.type === 'password') {
        pass.type = 'text';
        icon.textContent = '🙈';
    } else {
        pass.type = 'password';
        icon.textContent = '👁';
    }
}

function handleLogin(e) {
    e.preventDefault();

    const email    = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const errorBox = document.getElementById('errorBox');
    const btn      = document.getElementById('submitBtn');
    const btnText  = document.getElementById('btnText');
    const spinner  = document.getElementById('btnSpinner');

    // Basic validation
    if (!email || !password) {
        errorBox.textContent = 'Mohon isi email dan kata sandi.';
        errorBox.classList.remove('hidden');
        return;
    }

    // Show loading state
    errorBox.classList.add('hidden');
    btn.disabled = true;
    btnText.textContent = 'Memproses...';
    spinner.classList.remove('hidden');

    // Simulate request (replace with actual Laravel form submit)
    setTimeout(() => {
        btn.disabled = false;
        btnText.textContent = 'Masuk ke Dashboard';
        spinner.classList.add('hidden');

        // For demo: show error (in real app, this is handled by Laravel)
        errorBox.textContent = 'Email atau kata sandi salah. Silakan coba lagi.';
        errorBox.classList.remove('hidden');

        // Shake animation
        const card = btn.closest('form');
        card.style.animation = 'shake 0.4s ease';
        setTimeout(() => card.style.animation = '', 400);
    }, 1200);
}

// Listen checkbox manually (for visual feedback)
document.getElementById('remember').addEventListener('change', function() {
    const box = this.nextElementSibling;
    const check = box.querySelector('svg');
    if (this.checked) {
        box.classList.add('bg-green-700');
        box.classList.remove('bg-gray-200');
        check.classList.remove('hidden');
    } else {
        box.classList.remove('bg-green-700');
        box.classList.add('bg-gray-200');
        check.classList.add('hidden');
    }
});
</script>

<style>
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%       { transform: translateX(-6px); }
    40%       { transform: translateX(6px); }
    60%       { transform: translateX(-4px); }
    80%       { transform: translateX(4px); }
}
</style>

</body>
</html>
