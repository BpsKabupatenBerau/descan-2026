<?php $__env->startSection('title', 'Tingkat Pendidikan - Statistik | Desa Cantik'); ?>

<?php $__env->startSection('content'); ?>




<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="<?php echo e(url('/')); ?>" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="<?php echo e(url('/statistik')); ?>" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-500">Kependudukan</span>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">Tingkat Pendidikan</span>
    </nav>
</div>




<div class="flex min-h-screen bg-stone-50">

    
    
    
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">

        <?php
        $kategori = $kategori ?? 'kependudukan';
        $subpage  = $subpage  ?? '';

        $kependudukanItems = [
            ['label' => 'Total Penduduk',       'icon' => '👥', 'href' => '/statistik/total-penduduk',       'slug' => 'total-penduduk'],
            ['label' => 'Jumlah KK',             'icon' => '🏠', 'href' => '/statistik/jumlah-kk',             'slug' => 'jumlah-kk'],
            ['label' => 'Tingkat Pendidikan',    'icon' => '📚', 'href' => '/statistik',                       'slug' => 'tingkat-pendidikan'],
            ['label' => 'Jenis Kelamin',         'icon' => '⚤',  'href' => '/statistik/jenis-kelamin',         'slug' => 'jenis-kelamin'],
            ['label' => 'Pertumbuhan Penduduk',  'icon' => '📈', 'href' => '/statistik/pertumbuhan-penduduk',  'slug' => 'pertumbuhan-penduduk'],
            ['label' => 'Usia Produktif',        'icon' => '💪', 'href' => '/statistik/usia-produktif',        'slug' => 'usia-produktif'],
            ['label' => 'Status Perkawinan',     'icon' => '💍', 'href' => '/statistik/status-perkawinan',     'slug' => 'status-perkawinan'],
        ];

        $saranaItems = [
            ['label' => 'Fasilitas Kesehatan',  'icon' => '🏥', 'href' => '/statistik/sarana-prasarana/fasilitas-kesehatan',  'slug' => 'fasilitas-kesehatan'],
            ['label' => 'Fasilitas Pendidikan', 'icon' => '🏫', 'href' => '/statistik/sarana-prasarana/fasilitas-pendidikan', 'slug' => 'fasilitas-pendidikan'],
            ['label' => 'Sarana Ibadah',        'icon' => '🕌', 'href' => '/statistik/sarana-prasarana/sarana-ibadah',        'slug' => 'sarana-ibadah'],
            ['label' => 'Sarana Olahraga',      'icon' => '⚽', 'href' => '/statistik/sarana-prasarana/sarana-olahraga',      'slug' => 'sarana-olahraga'],
            ['label' => 'Infrastruktur Jalan',  'icon' => '🛣️',  'href' => '/statistik/sarana-prasarana/infrastruktur-jalan',  'slug' => 'infrastruktur-jalan'],
        ];

        $ekonomiItems = [
            ['label' => 'UMKM',              'icon' => '🏪', 'href' => '/statistik/ekonomi/umkm',               'slug' => 'umkm'],
            ['label' => 'Mata Pencaharian',   'icon' => '⛏️',  'href' => '/statistik/ekonomi/mata-pencaharian',   'slug' => 'mata-pencaharian'],
            ['label' => 'Pendapatan Desa',    'icon' => '💵', 'href' => '/statistik/ekonomi/pendapatan-desa',    'slug' => 'pendapatan-desa'],
            ['label' => 'Produksi Pertanian', 'icon' => '🌾', 'href' => '/statistik/ekonomi/produksi-pertanian', 'slug' => 'produksi-pertanian'],
            ['label' => 'Kemiskinan',         'icon' => '📉', 'href' => '/statistik/ekonomi/tingkat-kemiskinan', 'slug' => 'tingkat-kemiskinan'],
        ];

        $sidebarTitle = match($kategori) {
            'sarana'  => 'Sarana & Prasarana',
            'ekonomi' => 'Ekonomi',
            default   => 'Kependudukan',
        };
        $sidebarItems = match($kategori) {
            'sarana'  => $saranaItems,
            'ekonomi' => $ekonomiItems,
            default   => $kependudukanItems,
        };
        ?>

        <div class="px-5 mb-2">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase"><?php echo e($sidebarTitle); ?></p>
        </div>
        <nav>
            <?php $__currentLoopData = $sidebarItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item['slug'] === $subpage): ?>
                <div class="flex items-stretch mx-3 mb-0.5">
                    <div class="w-1 bg-green-700 rounded-full flex-shrink-0"></div>
                    <span class="flex-1 bg-green-50 text-green-700 text-xs font-bold px-3 py-2.5 rounded-r flex items-center gap-2">
                        <span><?php echo e($item['icon']); ?></span> <?php echo e($item['label']); ?>

                    </span>
                </div>
                <?php else: ?>
                <a href="<?php echo e(url($item['href'])); ?>" class="flex items-center gap-2 mx-4 py-2 px-3 text-xs text-gray-600 hover:text-green-700 hover:bg-gray-50 rounded transition-colors mb-0.5">
                    <span><?php echo e($item['icon']); ?></span> <?php echo e($item['label']); ?>

                </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>

    </aside>


    
    
    
    <main class="flex-1 p-6 space-y-5">

        
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <div class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded mb-3">
                Kependudukan
            </div>
            <h1 class="text-gray-900 text-2xl font-bold">Tingkat Pendidikan Penduduk</h1>
            <p class="text-gray-500 text-sm mt-1">Distribusi tingkat pendidikan terakhir penduduk Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Data 2024</span>
                <span>📏 Satuan: Jiwa</span>
                <span>📖 Sumber: Disdukcapil 2024</span>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-gray-900 text-base font-bold mb-6">Grafik Tingkat Pendidikan</h2>

            <div class="relative" style="height: 380px;">
                <canvas id="chartPendidikan"></canvas>
            </div>

            
            <p class="text-gray-400 text-xs text-center mt-4">Jumlah (Jiwa)</p>
        </div>

    </main>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    const ctx = document.getElementById('chartPendidikan').getContext('2d');

    const data = {
        labels: ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'D3', 'S1', 'S2/S3'],
        datasets: [{
            label: 'Jumlah (Jiwa)',
            data: [120, 980, 756, 1240, 310, 430, 80],
            backgroundColor: [
                '#ef4444cc',
                '#3b82f6cc',
                '#10b981cc',
                '#8b5cf6cc',
                '#f59e0bcc',
                '#06b6d4cc',
                '#ef4444cc',
            ],
            borderColor: [
                '#ef4444',
                '#3b82f6',
                '#10b981',
                '#8b5cf6',
                '#f59e0b',
                '#06b6d4',
                '#ef4444',
            ],
            borderWidth: 2,
            borderRadius: 6,
            borderSkipped: false,
        }]
    };

    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.parsed.y.toLocaleString('id-ID') + ' Jiwa'
                    }
                },
                datalabels: false,
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { family: 'Inter', size: 11 },
                        color: '#6b7280',
                    },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    max: 1400,
                    ticks: {
                        stepSize: 350,
                        font: { family: 'Inter', size: 11 },
                        color: '#9ca3af',
                        callback: val => val.toLocaleString('id-ID'),
                    },
                    grid: {
                        color: '#f3f4f6',
                        lineWidth: 1,
                    },
                    border: { display: false, dash: [4, 4] }
                }
            },
            animation: {
                duration: 800,
                easing: 'easeInOutQuart',
            }
        }
    });
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Laravel\Herd Laravel\desacantikberau\resources\views/statistik.blade.php ENDPATH**/ ?>