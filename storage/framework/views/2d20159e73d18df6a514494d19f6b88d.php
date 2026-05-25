<?php $__env->startSection('title', 'Pendapatan Desa - Ekonomi | Desa Cantik'); ?>

<?php $__env->startSection('content'); ?>


<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="<?php echo e(url('/')); ?>" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="<?php echo e(url('/statistik')); ?>" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-500">Ekonomi</span>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">Pendapatan Desa</span>
    </nav>
</div>


<div class="flex min-h-screen bg-stone-50">

    
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        <?php
        $kategori = 'ekonomi';
        $subpage  = 'pendapatan-desa';

        $ekonomiItems = [
            ['label' => 'UMKM',              'icon' => '🏪', 'href' => '/statistik/ekonomi/umkm',               'slug' => 'umkm'],
            ['label' => 'Mata Pencaharian',   'icon' => '⛏️',  'href' => '/statistik/ekonomi/mata-pencaharian',   'slug' => 'mata-pencaharian'],
            ['label' => 'Pendapatan Desa',    'icon' => '💵', 'href' => '/statistik/ekonomi/pendapatan-desa',    'slug' => 'pendapatan-desa'],
            ['label' => 'Produksi Pertanian', 'icon' => '🌾', 'href' => '/statistik/ekonomi/produksi-pertanian', 'slug' => 'produksi-pertanian'],
            ['label' => 'Kemiskinan',         'icon' => '📉', 'href' => '/statistik/ekonomi/tingkat-kemiskinan', 'slug' => 'tingkat-kemiskinan'],
        ];
        ?>

        <div class="px-5 mb-2">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Ekonomi</p>
        </div>
        <nav>
            <?php $__currentLoopData = $ekonomiItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

        
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded mb-3">
                Ekonomi
            </div>
            <h1 class="text-gray-900 text-2xl font-bold">Pendapatan Desa</h1>
            <p class="text-gray-500 text-sm mt-1">Realisasi pendapatan APBDes Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Rp Juta</span>
                <span>📖 APBDes 2024</span>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-1">
                <h2 class="text-gray-900 text-base font-bold">Grafik — Pendapatan Desa</h2>
            </div>
            <div class="flex items-center gap-4 mb-5">
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-green-700"></div>
                    <span class="text-gray-700 text-[10px]">PAD (Rp Juta)</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-500"></div>
                    <span class="text-gray-700 text-[10px]">Transfer Desa</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                    <span class="text-gray-700 text-[10px]">Lain-lain</span>
                </div>
                <span class="text-gray-400 text-[9px]">Satuan: Rp Juta</span>
            </div>

            <div class="relative" style="height: 320px;">
                <canvas id="chartPendapatanDesa"></canvas>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

            
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-gray-900 text-sm font-bold">Data Tabel</h2>
                    <p class="text-gray-500 text-xs mt-0.5">6 baris data</p>
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
                            <button onclick="unduhPDF()"
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
                <table class="w-full text-xs" id="tabel-pendapatan">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Sumber Pendapatan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">2022</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">2023</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">2024</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Naik/Turun</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rows = [
                            ['label' => 'PAD Desa',             'y22' => 'Rp 610 jt', 'y23' => 'Rp 740 jt', 'y24' => 'Rp 890 jt', 'pct' => '↑ 20,3%', 'stripe' => true,  'color' => 'bg-green-700'],
                            ['label' => 'Dana Desa (Transfer)', 'y22' => 'Rp 920 jt', 'y23' => 'Rp 960 jt', 'y24' => 'Rp 1,02 M', 'pct' => '↑ 6,3%',  'stripe' => false, 'color' => 'bg-blue-500'],
                            ['label' => 'ADD (Alokasi)',        'y22' => 'Rp 280 jt', 'y23' => 'Rp 310 jt', 'y24' => 'Rp 340 jt', 'pct' => '↑ 9,7%',  'stripe' => true,  'color' => 'bg-cyan-500'],
                            ['label' => 'Bagi Hasil Pajak',     'y22' => 'Rp 48 jt',  'y23' => 'Rp 54 jt',  'y24' => 'Rp 62 jt',  'pct' => '↑ 14,8%', 'stripe' => false, 'color' => 'bg-sky-500'],
                            ['label' => 'Lain-lain Sah',        'y22' => 'Rp 140 jt', 'y23' => 'Rp 160 jt', 'y24' => 'Rp 200 jt', 'pct' => '↑ 25,0%', 'stripe' => true,  'color' => 'bg-amber-500'],
                            ['label' => 'Total',                'y22' => 'Rp 1,998 M','y23' => 'Rp 2,224 M','y24' => 'Rp 2,512 M','pct' => '↑ 12,9%', 'stripe' => false, 'color' => 'bg-gray-500', 'isTotal' => true],
                        ];
                        ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($row['stripe'] ? 'bg-gray-50/60' : 'bg-white'); ?> border-t border-gray-100 <?php echo e(isset($row['isTotal']) ? 'font-bold bg-gray-50/80' : ''); ?>">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full <?php echo e($row['color']); ?> flex-shrink-0"></span>
                                    <span class="text-gray-900 font-medium"><?php echo e($row['label']); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['y22']); ?></td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['y23']); ?></td>
                            <td class="px-6 py-3 text-gray-700 font-semibold"><?php echo e($row['y24']); ?></td>
                            <td class="px-6 py-3">
                                <span class="text-green-600 font-semibold"><?php echo e($row['pct']); ?></span>
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
    const ctx = document.getElementById('chartPendapatanDesa').getContext('2d');

    const years = ['2019', '2020', '2021', '2022', '2023', '2024'];

    const padValues = [495, 405, 435, 610, 740, 890];
    const transferValues = [835, 865, 885, 920, 960, 1020];
    const lainValues = [135, 105, 125, 140, 160, 200];

    const padGradient = ctx.createLinearGradient(0, 0, 0, 300);
    padGradient.addColorStop(0, 'rgba(21,128,61,0.12)');
    padGradient.addColorStop(1, 'rgba(21,128,61,0)');

    const transferGradient = ctx.createLinearGradient(0, 0, 0, 300);
    transferGradient.addColorStop(0, 'rgba(59,130,246,0.12)');
    transferGradient.addColorStop(1, 'rgba(59,130,246,0)');

    const lainGradient = ctx.createLinearGradient(0, 0, 0, 300);
    lainGradient.addColorStop(0, 'rgba(245,158,11,0.12)');
    lainGradient.addColorStop(1, 'rgba(245,158,11,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [
                {
                    label: 'PAD',
                    data: padValues,
                    borderColor: '#15803d',
                    borderWidth: 2.5,
                    backgroundColor: padGradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#15803d',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                },
                {
                    label: 'Transfer Desa',
                    data: transferValues,
                    borderColor: '#3b82f6',
                    borderWidth: 2.5,
                    backgroundColor: transferGradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                },
                {
                    label: 'Lain-lain',
                    data: lainValues,
                    borderColor: '#f59e0b',
                    borderWidth: 2.5,
                    backgroundColor: lainGradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#f59e0b',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.dataset.label}: Rp ${ctx.parsed.y} Juta`
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter', size: 11 }, color: '#6b7280' },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    max: 1100,
                    ticks: {
                        stepSize: 220,
                        font: { family: 'Inter', size: 10 },
                        color: '#9ca3af',
                        callback: val => 'Rp ' + val.toLocaleString('id-ID') + ' jt',
                    },
                    grid: { color: '#f3f4f6', lineWidth: 1 },
                    border: { display: false, dash: [4, 4] }
                }
            },
            animation: { duration: 900, easing: 'easeInOutQuart' }
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
        ['Sumber Pendapatan', '2022', '2023', '2024', 'Naik/Turun'],
        ['PAD Desa', 'Rp 610 jt', 'Rp 740 jt', 'Rp 890 jt', '20.3%'],
        ['Dana Desa (Transfer)', 'Rp 920 jt', 'Rp 960 jt', 'Rp 1.02 M', '6.3%'],
        ['ADD (Alokasi)', 'Rp 280 jt', 'Rp 310 jt', 'Rp 340 jt', '9.7%'],
        ['Bagi Hasil Pajak', 'Rp 48 jt', 'Rp 54 jt', 'Rp 62 jt', '14.8%'],
        ['Lain-lain Sah', 'Rp 140 jt', 'Rp 160 jt', 'Rp 200 jt', '25.0%'],
        ['Total', 'Rp 1.998 M', 'Rp 2.224 M', 'Rp 2.512 M', '12.9%']
    ];
    const csvContent = "\uFEFF" + rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'pendapatan-desa-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-pendapatan');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim().replace(/\n/g, ' ') + '"');
        csv += cols.join(',') + '\n';
    }
    const csvContent = "\uFEFF" + csv;
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'pendapatan-desa-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhPDF() {
    window.print();
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Laravel\Herd Laravel\desacantikberau\resources\views/statistik-pendapatan-desa.blade.php ENDPATH**/ ?>