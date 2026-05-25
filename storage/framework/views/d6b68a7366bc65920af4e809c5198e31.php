<?php $__env->startSection('title', 'Data UMKM - Ekonomi | Desa Cantik'); ?>

<?php $__env->startSection('content'); ?>


<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="<?php echo e(url('/')); ?>" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="<?php echo e(url('/statistik')); ?>" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-500">Ekonomi</span>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">UMKM</span>
    </nav>
</div>


<div class="flex min-h-screen bg-stone-50">

    
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        <?php
        $kategori = 'ekonomi';
        $subpage  = 'umkm';

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
            <h1 class="text-gray-900 text-2xl font-bold">Data UMKM</h1>
            <p class="text-gray-500 text-sm mt-1">Usaha Mikro, Kecil, dan Menengah di Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Unit</span>
                <span>📖 Dinas Koperasi 2024</span>
            </div>
        </div>

        
        <div class="grid grid-cols-4 gap-4">

            
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-amber-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Jumlah UMKM</p>
                        <p class="text-amber-500 text-3xl font-bold leading-none">248</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-green-700 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Omzet / Tahun</p>
                        <p class="text-green-700 text-3xl font-bold leading-none">Rp 3,2M</p>
                        <p class="text-gray-400 text-[10px] mt-2">Estimasi</p>
                    </div>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-blue-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Tenaga Kerja</p>
                        <p class="text-blue-500 text-3xl font-bold leading-none">486</p>
                        <p class="text-gray-400 text-[10px] mt-2">Orang</p>
                    </div>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-teal-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">UMKM Naik Kelas</p>
                        <p class="text-teal-500 text-3xl font-bold leading-none">34</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-1">
                <h2 class="text-gray-900 text-base font-bold">Grafik — Data UMKM</h2>
            </div>
            <div class="flex items-center gap-4 mb-5">
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-green-700"></div>
                    <span class="text-gray-700 text-[10px]">Jumlah Sektor UMKM</span>
                </div>
                <span class="text-gray-400 text-[9px]">Satuan: Unit</span>
            </div>

            <div class="relative" style="height: 320px;">
                <canvas id="chartUmkm"></canvas>
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
                <table class="w-full text-xs" id="tabel-umkm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Sektor</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jumlah</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Tenaga Kerja</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Omzet/Bulan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rows = [
                            ['sector' => 'Kuliner',     'jumlah' => '84 Unit',  'pekerja' => '168 Orang', 'omzet' => 'Rp 210 jt', 'keterangan' => 'Terbesar',    'stripe' => true,  'color' => 'bg-amber-500'],
                            ['sector' => 'Pertanian',    'jumlah' => '62 Unit',  'pekerja' => '186 Orang', 'omzet' => 'Rp 310 jt', 'keterangan' => 'Musiman',     'stripe' => false, 'color' => 'bg-green-700'],
                            ['sector' => 'Perdagangan', 'jumlah' => '42 Unit',  'pekerja' => '84 Orang',  'omzet' => 'Rp 180 jt', 'keterangan' => '—',           'stripe' => true,  'color' => 'bg-blue-500'],
                            ['sector' => 'Kerajinan',   'jumlah' => '36 Unit',  'pekerja' => '72 Orang',  'omzet' => 'Rp 90 jt',  'keterangan' => 'Ekspor lokal', 'stripe' => false, 'color' => 'bg-violet-500'],
                            ['sector' => 'Jasa',        'jumlah' => '18 Unit',  'pekerja' => '36 Orang',  'omzet' => 'Rp 45 jt',  'keterangan' => '—',           'stripe' => true,  'color' => 'bg-teal-500'],
                            ['sector' => 'Lainnya',     'jumlah' => '6 Unit',   'pekerja' => '12 Orang',  'omzet' => 'Rp 15 jt',  'keterangan' => '—',           'stripe' => false, 'color' => 'bg-gray-500'],
                        ];
                        ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($row['stripe'] ? 'bg-gray-50/60' : 'bg-white'); ?> border-t border-gray-100">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full <?php echo e($row['color']); ?> flex-shrink-0"></span>
                                    <span class="text-gray-900 font-medium"><?php echo e($row['sector']); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['jumlah']); ?></td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['pekerja']); ?></td>
                            <td class="px-6 py-3 text-gray-700"><?php echo e($row['omzet']); ?></td>
                            <td class="px-6 py-3 text-gray-700">
                                <?php if($row['keterangan'] === '—'): ?>
                                    <span class="text-gray-400">—</span>
                                <?php elseif($row['keterangan'] === 'Terbesar'): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <?php echo e($row['keterangan']); ?>

                                    </span>
                                <?php elseif($row['keterangan'] === 'Ekspor lokal'): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-violet-50 text-violet-700 border border-violet-200">
                                        <?php echo e($row['keterangan']); ?>

                                    </span>
                                <?php else: ?>
                                    <?php echo e($row['keterangan']); ?>

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
    const ctx = document.getElementById('chartUmkm').getContext('2d');

    const labels = ['Kuliner', 'Kerajinan', 'Pertanian', 'Perdagangan', 'Jasa', 'Lainnya'];
    const values = [84, 36, 62, 42, 18, 6];
    const colors = {
        bg:     ['rgba(245,158,11,0.85)', 'rgba(139,92,246,0.85)', 'rgba(21,128,61,0.85)', 'rgba(59,130,246,0.85)', 'rgba(20,184,166,0.85)', 'rgba(107,114,128,0.85)'],
        border: ['#f59e0b',              '#8b5cf6',              '#15803d',              '#3b82f6',              '#14b8a6',              '#6b7280'],
    };

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Unit',
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
                        label: ctx => ' ' + ctx.parsed.y + ' Unit'
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
                    max: 90,
                    ticks: {
                        stepSize: 15,
                        font: { family: 'Inter', size: 10 },
                        color: '#9ca3af',
                        callback: val => val,
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
        ['Sektor', 'Jumlah', 'Tenaga Kerja', 'Omzet/Bulan', 'Keterangan'],
        ['Kuliner', '84 Unit', '168 Orang', 'Rp 210 jt', 'Terbesar'],
        ['Pertanian', '62 Unit', '186 Orang', 'Rp 310 jt', 'Musiman'],
        ['Perdagangan', '42 Unit', '84 Orang', 'Rp 180 jt', '-'],
        ['Kerajinan', '36 Unit', '72 Orang', 'Rp 90 jt', 'Ekspor lokal'],
        ['Jasa', '18 Unit', '36 Orang', 'Rp 45 jt', '-'],
        ['Lainnya', '6 Unit', '12 Orang', 'Rp 15 jt', '-']
    ];
    const csvContent = "\uFEFF" + rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'data-umkm-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-umkm');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim().replace(/\n/g, ' ') + '"');
        csv += cols.join(',') + '\n';
    }
    const csvContent = "\uFEFF" + csv;
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'data-umkm-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhPDF() {
    window.print();
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Laravel\Herd Laravel\desacantikberau\resources\views/statistik-umkm.blade.php ENDPATH**/ ?>