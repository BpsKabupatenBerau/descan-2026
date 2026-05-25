<?php $__env->startSection('title', 'Tingkat Pendidikan - Kependudukan | Desa Cantik'); ?>

<?php $__env->startSection('content'); ?>


<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="<?php echo e(url('/')); ?>" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="<?php echo e(url('/statistik')); ?>" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <a href="<?php echo e(url('/statistik')); ?>" class="hover:text-green-700 transition-colors">Kependudukan</a>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">Tingkat Pendidikan</span>
    </nav>
</div>


<div class="flex min-h-screen bg-stone-50">

    
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        <?php
        $subpage = $subpage ?? 'tingkat-pendidikan';
        $sidebarItems = [
            ['label' => 'Total Penduduk',      'icon' => '👥', 'href' => '/statistik/total-penduduk',      'slug' => 'total-penduduk'],
            ['label' => 'Jumlah KK',            'icon' => '🏠', 'href' => '/statistik/jumlah-kk',            'slug' => 'jumlah-kk'],
            ['label' => 'Tingkat Pendidikan',   'icon' => '📚', 'href' => '/statistik',                      'slug' => 'tingkat-pendidikan'],
            ['label' => 'Jenis Kelamin',        'icon' => '⚤',  'href' => '/statistik/jenis-kelamin',        'slug' => 'jenis-kelamin'],
            ['label' => 'Pertumbuhan Penduduk', 'icon' => '📈', 'href' => '/statistik/pertumbuhan-penduduk', 'slug' => 'pertumbuhan-penduduk'],
            ['label' => 'Usia Produktif',       'icon' => '💪', 'href' => '/statistik/usia-produktif',       'slug' => 'usia-produktif'],
            ['label' => 'Status Perkawinan',    'icon' => '💍', 'href' => '/statistik/status-perkawinan',    'slug' => 'status-perkawinan'],
        ];
        ?>

        <div class="px-5 mb-2">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Kependudukan</p>
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
            <h1 class="text-gray-900 text-2xl font-bold">Tingkat Pendidikan</h1>
            <p class="text-gray-500 text-sm mt-1">Distribusi tingkat pendidikan terakhir penduduk Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Jiwa</span>
                <span>📖 Disdukcapil 2024</span>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-gray-900 text-base font-bold mb-1">Grafik — Tingkat Pendidikan</h2>
            <p class="text-gray-400 text-[9px] mb-5">Satuan: Jiwa</p>

            <div class="relative" style="height: 320px;">
                <canvas id="chartPendidikan"></canvas>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-gray-900 text-sm font-bold">Data Tabel</h2>
                    <p class="text-gray-500 text-xs mt-0.5">7 baris data</p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="window.print()"
                        class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-700 text-xs font-bold hover:bg-gray-50 transition-colors">
                        <span>🖨</span> Print
                    </button>
                    <div class="relative" id="unduh-wrapper">
                        <button onclick="toggleUnduhDropdown()"
                            class="flex items-center gap-2 px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-lg hover:bg-green-800 transition-colors">
                            ⬇ Unduh Data
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="unduh-menu"
                            class="hidden absolute right-0 top-full mt-1.5 w-44 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50">
                            <button onclick="unduhCSV()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-red-500 hover:bg-red-50 transition-colors">
                                <span>📄</span> Unduh PDF
                            </button>
                            <div class="border-t border-gray-100 mx-3"></div>
                            <button onclick="unduhCSV()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-gray-700 hover:bg-gray-50 transition-colors">
                                <span>📊</span> Unduh CSV
                            </button>
                            <div class="border-t border-gray-100 mx-3"></div>
                            <button onclick="unduhExcel()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-gray-700 hover:bg-gray-50 transition-colors">
                                <span>📗</span> Unduh Excel
                            </button>
                            <div class="border-t border-gray-100 mx-3"></div>
                            <button onclick="window.print()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-gray-700 hover:bg-gray-50 transition-colors">
                                <span>🖨</span> Cetak / Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="overflow-x-auto">
                <table class="w-full text-xs" id="tabel-pendidikan">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Tingkat Pendidikan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Laki-laki</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Perempuan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Total</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rows = [
                            ['label' => 'Tidak Sekolah',  'l' => '58',  'p' => '62',  'total' => '120',   'pct' => '2,5%',  'stripe' => true,  'color' => 'bg-red-500'],
                            ['label' => 'SD / Sederajat', 'l' => '490', 'p' => '490', 'total' => '980',   'pct' => '20,1%', 'stripe' => false, 'color' => 'bg-emerald-500'],
                            ['label' => 'SMP / Sederajat','l' => '380', 'p' => '376', 'total' => '756',   'pct' => '15,5%', 'stripe' => true,  'color' => 'bg-amber-500'],
                            ['label' => 'SMA / SMK',      'l' => '630', 'p' => '610', 'total' => '1.240', 'pct' => '25,5%', 'stripe' => false, 'color' => 'bg-blue-500'],
                            ['label' => 'D3',             'l' => '148', 'p' => '162', 'total' => '310',   'pct' => '6,4%',  'stripe' => true,  'color' => 'bg-violet-500'],
                            ['label' => 'S1',             'l' => '212', 'p' => '218', 'total' => '430',   'pct' => '8,8%',  'stripe' => false, 'color' => 'bg-teal-500'],
                            ['label' => 'S2 / S3',        'l' => '38',  'p' => '42',  'total' => '80',    'pct' => '1,6%',  'stripe' => true,  'color' => 'bg-amber-400'],
                        ];
                        ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($row['stripe'] ? 'bg-gray-50/60' : 'bg-white'); ?> border-t border-gray-100">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full <?php echo e($row['color']); ?> flex-shrink-0"></span>
                                    <span class="text-gray-900 font-medium"><?php echo e($row['label']); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['l']); ?></td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['p']); ?></td>
                            <td class="px-6 py-3 text-gray-700 font-semibold"><?php echo e($row['total']); ?></td>
                            <td class="px-6 py-3">
                                <span class="text-gray-500"><?php echo e($row['pct']); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    const ctx = document.getElementById('chartPendidikan').getContext('2d');

    const labels = ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'D3', 'S1', 'S2/S3'];
    const values = [120, 980, 756, 1240, 310, 430, 80];
    const colors = {
        bg:     ['rgba(239,68,68,0.85)',  'rgba(16,185,129,0.85)', 'rgba(245,158,11,0.85)', 'rgba(59,130,246,0.85)',  'rgba(139,92,246,0.85)', 'rgba(20,184,166,0.85)', 'rgba(245,158,11,0.7)'],
        border: ['#ef4444',              '#10b981',               '#f59e0b',               '#3b82f6',               '#8b5cf6',               '#14b8a6',               '#f59e0b'],
    };

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah (Jiwa)',
                data: values,
                backgroundColor: colors.bg,
                borderColor:     colors.border,
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
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
                    ticks: { font: { family: 'Inter', size: 11 }, color: '#6b7280' },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    max: 1400,
                    ticks: {
                        stepSize: 310,
                        font: { family: 'Inter', size: 10 },
                        color: '#9ca3af',
                        callback: val => val.toLocaleString('id-ID'),
                    },
                    grid: { color: '#f3f4f6', lineWidth: 1 },
                    border: { display: false, dash: [4, 4] }
                }
            },
            animation: { duration: 800, easing: 'easeInOutQuart' }
        }
    });
})();

// Unduh dropdown
function toggleUnduhDropdown() {
    document.getElementById('unduh-menu').classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('unduh-wrapper');
    const menu    = document.getElementById('unduh-menu');
    if (wrapper && !wrapper.contains(e.target)) menu.classList.add('hidden');
});

function unduhCSV() {
    const rows = [
        ['Tingkat Pendidikan', 'Laki-laki', 'Perempuan', 'Total', '%'],
        ['Tidak Sekolah',  58,  62,  120,  '2.5%'],
        ['SD / Sederajat', 490, 490, 980,  '20.1%'],
        ['SMP / Sederajat',380, 376, 756,  '15.5%'],
        ['SMA / SMK',      630, 610, 1240, '25.5%'],
        ['D3',             148, 162, 310,  '6.4%'],
        ['S1',             212, 218, 430,  '8.8%'],
        ['S2 / S3',        38,  42,  80,   '1.6%'],
    ];
    const csv  = rows.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'tingkat-pendidikan.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-pendidikan');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim() + '"');
        csv += cols.join(',') + '\n';
    }
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'tingkat-pendidikan.csv';
    a.click();
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Laravel\Herd Laravel\desacantikberau\resources\views/statistik-tingkat-pendidikan.blade.php ENDPATH**/ ?>