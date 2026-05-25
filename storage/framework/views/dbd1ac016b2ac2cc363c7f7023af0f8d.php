<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal resmi data statistik, peta wilayah, infografis, dan publikasi dokumen Kampung Tanjung Perangat, Kecamatan Sambaliung, Kabupaten Berau.">
    <title><?php echo $__env->yieldContent('title', 'Desa Cantik - Data & Informasi Kampung Tanjung Perangat'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-stone-50 font-sans antialiased">


<div class="w-full bg-green-900 py-1.5 text-center">
    <p class="text-green-200 text-xs">
        Selamat datang di Portal Data Kampung Tanjung Perangat, Kecamatan Sambaliung, Kabupaten Berau
    </p>
</div>


<nav class="w-full bg-white border-b border-gray-200 px-8 h-14 flex items-center justify-between sticky top-0 z-50 shadow-sm">
    
    <div class="flex items-center gap-3 flex-shrink-0">
        <div class="w-9 h-9 rounded-lg bg-green-800 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </div>
        <div>
            <p class="text-gray-900 text-sm font-bold leading-none">Desa Cantik</p>
            <p class="text-gray-500 text-xs">Data &amp; Informasi</p>
        </div>
    </div>

    
    <div class="flex items-center gap-1">
        <a href="<?php echo e(url('/')); ?>"
           class="px-4 py-2 text-xs font-medium rounded transition-colors
                  <?php echo e(($activeNav ?? '') === 'beranda' ? 'bg-green-100 text-green-700 font-bold' : 'text-gray-600 hover:text-green-700 hover:bg-gray-50'); ?>">
            Beranda
        </a>
        
        <div class="relative" id="statistik-dropdown-wrapper">
            <button
                id="statistik-btn"
                type="button"
                onclick="toggleStatistikDropdown()"
                class="flex items-center gap-1 px-4 py-2 text-xs font-medium rounded transition-colors
                       <?php echo e(($activeNav ?? '') === 'statistik' ? 'bg-green-100 text-green-700 font-bold' : 'text-gray-600 hover:text-green-700 hover:bg-gray-50'); ?>">
                Statistik
                <svg id="statistik-chevron" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            
            <div
                id="statistik-menu"
                class="hidden absolute left-0 top-full mt-1.5 w-52 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50"
            >
                
                <a href="<?php echo e(url('/statistik')); ?>"
                   class="flex items-center gap-3 px-4 py-2.5 hover:bg-green-50 hover:text-green-700 transition-colors group">
                    <span class="w-7 h-7 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0 group-hover:bg-green-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-green-700" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="text-xs font-semibold text-gray-800 group-hover:text-green-700">Kependudukan</p>
                        <p class="text-[10px] text-gray-400">Data penduduk & demografi</p>
                    </div>
                </a>

                
                <a href="<?php echo e(url('/statistik/sarana-prasarana')); ?>"
                   class="flex items-center gap-3 px-4 py-2.5 hover:bg-green-50 hover:text-green-700 transition-colors group">
                    <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 3L2 12h3v9h6v-6h2v6h6v-9h3L12 3zm0 12.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="text-xs font-semibold text-gray-800 group-hover:text-green-700">Sarana & Prasarana</p>
                        <p class="text-[10px] text-gray-400">Fasilitas & infrastruktur</p>
                    </div>
                </a>

                
                <a href="<?php echo e(url('/statistik/ekonomi')); ?>"
                   class="flex items-center gap-3 px-4 py-2.5 hover:bg-green-50 hover:text-green-700 transition-colors group">
                    <span class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-amber-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="text-xs font-semibold text-gray-800 group-hover:text-green-700">Ekonomi</p>
                        <p class="text-[10px] text-gray-400">Mata pencaharian & kemiskinan</p>
                    </div>
                </a>
            </div>
        </div>
        <a href="<?php echo e(url('/spasial')); ?>"
           class="px-4 py-2 text-xs font-medium rounded transition-colors
                  <?php echo e(($activeNav ?? '') === 'spasial' ? 'bg-green-100 text-green-700 font-bold' : 'text-gray-600 hover:text-green-700 hover:bg-gray-50'); ?>">
            Spasial
        </a>
        <a href="<?php echo e(url('/infografis')); ?>"
           class="px-4 py-2 text-xs font-medium rounded transition-colors
                  <?php echo e(($activeNav ?? '') === 'infografis' ? 'bg-green-100 text-green-700 font-bold' : 'text-gray-600 hover:text-green-700 hover:bg-gray-50'); ?>">
            Infografis
        </a>
        <a href="<?php echo e(url('/publikasi')); ?>"
           class="px-4 py-2 text-xs font-medium rounded transition-colors
                  <?php echo e(($activeNav ?? '') === 'publikasi' ? 'bg-green-100 text-green-700 font-bold' : 'text-gray-600 hover:text-green-700 hover:bg-gray-50'); ?>">
            Publikasi
        </a>
    </div>

    
    <a href="<?php echo e(route('login')); ?>" id="btn-login" class="px-5 py-2 bg-green-900 text-white text-xs font-bold rounded-lg hover:bg-green-800 transition-colors flex-shrink-0">
        Login
    </a>
</nav>


<?php echo $__env->yieldContent('content'); ?>


<footer class="w-full bg-gray-900 px-8 pt-8 pb-6">
    <p class="text-white text-sm font-bold">Desa Cantik</p>
    <p class="text-gray-400 text-xs mt-1">Portal resmi data dan informasi Kampung Tanjung Perangat</p>
    <div class="border-t border-gray-800 mt-6 pt-4 flex items-center justify-between">
        <p class="text-gray-600 text-[10px]">© 2026 Desa Cantik Kabupaten Berau. Hak cipta dilindungi.</p>
        <p class="text-gray-600 text-[10px]">Dibangun dengan Laravel &amp; Filament</p>
    </div>
</footer>

<?php echo $__env->yieldPushContent('scripts'); ?>
<script>
function toggleStatistikDropdown() {
    const menu    = document.getElementById('statistik-menu');
    const chevron = document.getElementById('statistik-chevron');
    const isOpen  = !menu.classList.contains('hidden');
    if (isOpen) {
        menu.classList.add('hidden');
        chevron.style.transform = 'rotate(0deg)';
    } else {
        menu.classList.remove('hidden');
        chevron.style.transform = 'rotate(180deg)';
    }
}

// Tutup dropdown saat klik di luar
document.addEventListener('click', function (e) {
    const wrapper = document.getElementById('statistik-dropdown-wrapper');
    const menu    = document.getElementById('statistik-menu');
    const chevron = document.getElementById('statistik-chevron');
    if (wrapper && !wrapper.contains(e.target)) {
        menu.classList.add('hidden');
        chevron.style.transform = 'rotate(0deg)';
    }
});
</script>
</body>
</html>
<?php /**PATH E:\Laravel\Herd Laravel\desacantikberau\resources\views/layouts/app.blade.php ENDPATH**/ ?>