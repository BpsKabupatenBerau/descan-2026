<?php $__env->startSection('title', 'Pertumbuhan Penduduk - Kependudukan | Desa Cantik'); ?>

<?php $__env->startSection('content'); ?>


<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="<?php echo e(url('/')); ?>" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="<?php echo e(url('/statistik')); ?>" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <a href="<?php echo e(url('/statistik')); ?>" class="hover:text-green-700 transition-colors">Kependudukan</a>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">Pertumbuhan Penduduk</span>
    </nav>
</div>


<div class="flex min-h-screen bg-stone-50">

    
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        <?php
        $subpage = $subpage ?? 'pertumbuhan-penduduk';
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
            <h1 class="text-gray-900 text-2xl font-bold">Pertumbuhan Penduduk</h1>
            <p class="text-gray-500 text-sm mt-1">Tren pertumbuhan penduduk Kampung Tanjung Perangat 2019–2024</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Jiwa</span>
                <span>📖 Disdukcapil 2024</span>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-gray-900 text-base font-bold mb-1">Grafik — Pertumbuhan Penduduk</h2>

            
            <div class="flex items-center gap-6 mb-5">
                <p class="text-gray-400 text-[9px]">Satuan: Jiwa</p>
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-500"></div>
                    <span class="text-gray-700 text-[10px]">Total Penduduk</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-sky-500"></div>
                    <span class="text-gray-700 text-[10px]">Laki-laki</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-violet-500"></div>
                    <span class="text-gray-700 text-[10px]">Perempuan</span>
                </div>
            </div>

            <div class="relative" style="height: 320px;">
                <canvas id="chartPertumbuhan"></canvas>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

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
                <table class="w-full text-xs" id="tabel-pertumbuhan">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Tahun</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Laki-laki</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Perempuan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Total</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Pertumbuhan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Laju (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rows = [
                            ['tahun'=>'2019','l'=>'2.160','p'=>'2.150','total'=>'4.310','tumbuh'=>'-',    'laju'=>'-',     'stripe'=>true],
                            ['tahun'=>'2020','l'=>'2.210','p'=>'2.200','total'=>'4.410','tumbuh'=>'+100', 'laju'=>'+2,32%','stripe'=>false],
                            ['tahun'=>'2021','l'=>'2.280','p'=>'2.240','total'=>'4.520','tumbuh'=>'+110', 'laju'=>'+2,49%','stripe'=>true],
                            ['tahun'=>'2022','l'=>'2.350','p'=>'2.330','total'=>'4.680','tumbuh'=>'+160', 'laju'=>'+3,54%','stripe'=>false],
                            ['tahun'=>'2023','l'=>'2.410','p'=>'2.370','total'=>'4.780','tumbuh'=>'+100', 'laju'=>'+2,14%','stripe'=>true],
                            ['tahun'=>'2024','l'=>'2.480','p'=>'2.392','total'=>'4.872','tumbuh'=>'+92',  'laju'=>'+1,92%','stripe'=>false],
                        ];
                        ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($row['stripe'] ? 'bg-gray-50/60' : 'bg-white'); ?> border-t border-gray-100">
                            <td class="px-6 py-3 text-gray-900 font-medium"><?php echo e($row['tahun']); ?></td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['l']); ?></td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['p']); ?></td>
                            <td class="px-6 py-3 text-gray-700 font-semibold"><?php echo e($row['total']); ?></td>
                            <td class="px-6 py-3">
                                <?php if($row['tumbuh'] === '-'): ?>
                                    <span class="text-gray-400">—</span>
                                <?php else: ?>
                                    <span class="text-green-600 font-semibold"><?php echo e($row['tumbuh']); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-3">
                                <?php if($row['laju'] === '-'): ?>
                                    <span class="text-gray-400">—</span>
                                <?php else: ?>
                                    <span class="text-green-600 font-semibold"><?php echo e($row['laju']); ?></span>
                                <?php endif; ?>
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
    const ctx  = document.getElementById('chartPertumbuhan').getContext('2d');
    const years = ['2019', '2020', '2021', '2022', '2023', '2024'];

    // Gradients
    const gradBlue   = ctx.createLinearGradient(0, 0, 0, 320);
    gradBlue.addColorStop(0, 'rgba(59,130,246,0.15)');
    gradBlue.addColorStop(1, 'rgba(59,130,246,0)');

    const gradSky    = ctx.createLinearGradient(0, 0, 0, 320);
    gradSky.addColorStop(0, 'rgba(14,165,233,0.12)');
    gradSky.addColorStop(1, 'rgba(14,165,233,0)');

    const gradViolet = ctx.createLinearGradient(0, 0, 0, 320);
    gradViolet.addColorStop(0, 'rgba(139,92,246,0.12)');
    gradViolet.addColorStop(1, 'rgba(139,92,246,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [
                {
                    label: 'Total Penduduk',
                    data: [4310, 4410, 4520, 4680, 4780, 4872],
                    borderColor: '#3b82f6',
                    backgroundColor: gradBlue,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                },
                {
                    label: 'Laki-laki',
                    data: [2160, 2210, 2280, 2350, 2410, 2480],
                    borderColor: '#0ea5e9',
                    backgroundColor: gradSky,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0ea5e9',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                },
                {
                    label: 'Perempuan',
                    data: [2150, 2200, 2240, 2330, 2370, 2392],
                    borderColor: '#8b5cf6',
                    backgroundColor: gradViolet,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#8b5cf6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.dataset.label + ': ' + ctx.parsed.y.toLocaleString('id-ID') + ' jiwa'
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
                    beginAtZero: false,
                    min: 2000,
                    max: 5200,
                    ticks: {
                        stepSize: 680,
                        font: { family: 'Inter', size: 10 },
                        color: '#9ca3af',
                        callback: val => val.toLocaleString('id-ID'),
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
        ['Tahun','Laki-laki','Perempuan','Total','Pertumbuhan','Laju (%)'],
        [2019, 2160, 2150, 4310, '-',    '-'],
        [2020, 2210, 2200, 4410, '+100', '+2.32%'],
        [2021, 2280, 2240, 4520, '+110', '+2.49%'],
        [2022, 2350, 2330, 4680, '+160', '+3.54%'],
        [2023, 2410, 2370, 4780, '+100', '+2.14%'],
        [2024, 2480, 2392, 4872, '+92',  '+1.92%'],
    ];
    const csv  = rows.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'pertumbuhan-penduduk.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-pertumbuhan');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim() + '"');
        csv += cols.join(',') + '\n';
    }
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'pertumbuhan-penduduk.csv';
    a.click();
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Laravel\Herd Laravel\desacantikberau\resources\views/statistik-pertumbuhan-penduduk.blade.php ENDPATH**/ ?>