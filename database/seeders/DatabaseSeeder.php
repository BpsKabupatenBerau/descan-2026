<?php

namespace Database\Seeders;

use App\Models\Bulan;
use App\Models\InputDataSpasial;
use App\Models\InputDataTabel;
use App\Models\InputInfografis;
use App\Models\InputPublikasi;
use App\Models\KategoriPublikasi;
use App\Models\KategoriSpasial;
use App\Models\KategoriStatistik;
use App\Models\SatuanStatistik;
use App\Models\Setting;
use App\Models\TabelStatistik;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Admin User ────────────────────────────────────
        $admin = User::updateOrCreate(
            ['email' => 'admin@descan.go.id'],
            [
                'nama_lengkap' => 'Administrator',
                'role'         => 'admin',
                'password'     => Hash::make('password'),
            ]
        );

        // ── 2. Tahun ─────────────────────────────────────────
        $tahunMap = [];
        foreach ([2021, 2022, 2023, 2024, 2025] as $y) {
            $tahunMap[$y] = Tahun::firstOrCreate(['tahun' => $y]);
        }

        // ── 3. Bulan ─────────────────────────────────────────
        $namaBulan = ['Januari','Februari','Maret','April','Mei','Juni',
                      'Juli','Agustus','September','Oktober','November','Desember'];
        foreach (range(1, 12) as $b) {
            Bulan::firstOrCreate(['bulan' => $b], ['nama' => $namaBulan[$b - 1]]);
        }

        // ── 4. Settings ──────────────────────────────────────
        $settings = [
            ['site_name',        'Desa Contoh',                                      'general'],
            ['site_tagline',     'Data & Informasi Statistik Desa',                  'general'],
            ['site_description', 'Portal resmi data statistik dan informasi desa.',  'general'],
            ['top_bar_text',     'Selamat datang di Portal Data Desa Contoh',        'general'],
            ['hero_title_1',     'Data & Informasi',                                 'general'],
            ['hero_title_2',     'Desa Contoh',                                      'general'],
            ['contact_address',  'Jl. Desa No. 1, Kecamatan Contoh',                'contact'],
            ['contact_phone',    '+62 812-3456-7890',                                'contact'],
            ['contact_email',    'desa@contoh.go.id',                               'contact'],
        ];
        foreach ($settings as [$key, $value, $group]) {
            Setting::set($key, $value, $group);
        }

        // ── 5. Kategori Statistik ────────────────────────────
        $katKependudukan = KategoriStatistik::firstOrCreate(
            ['judul_kategori' => 'Kependudukan'],
            ['user_id' => $admin->id, 'is_active' => true]
        );
        $katSarana = KategoriStatistik::firstOrCreate(
            ['judul_kategori' => 'Sarana'],
            ['user_id' => $admin->id, 'is_active' => true]
        );
        $katEkonomi = KategoriStatistik::firstOrCreate(
            ['judul_kategori' => 'Ekonomi'],
            ['user_id' => $admin->id, 'is_active' => true]
        );

        // ── 6. Satuan Statistik ──────────────────────────────
        $satuanMap = [];
        foreach (['Jiwa', 'KK', '%', 'Rp', 'Unit', 'Ha', 'Ton'] as $s) {
            $satuanMap[$s] = SatuanStatistik::firstOrCreate(
                ['judul_satuan' => $s],
                ['user_id' => $admin->id]
            );
        }

        // ── 7. Tabel Statistik ───────────────────────────────
        $tabelDefs = [
            ['Total Penduduk',       'kependudukan', 'number',   'Jiwa', 'Tahunan', 0],
            ['Jumlah KK',            'kependudukan', 'number',   'KK',   'Tahunan', 1],
            ['Tingkat Pendidikan',   'kependudukan', 'bar',      'Jiwa', 'Tahunan', 2],
            ['Jenis Kelamin',        'kependudukan', 'doughnut', 'Jiwa', 'Tahunan', 3],
            ['Pertumbuhan Penduduk', 'kependudukan', 'line',     'Jiwa', 'Tahunan', 4],
            ['Usia Produktif',       'kependudukan', 'bar',      'Jiwa', 'Tahunan', 5],
            ['Status Perkawinan',    'kependudukan', 'doughnut', 'Jiwa', 'Tahunan', 6],
            ['Fasilitas Kesehatan',  'sarana',       'bar',      'Unit', 'Tahunan', 0],
            ['Fasilitas Pendidikan', 'sarana',       'bar',      'Unit', 'Tahunan', 1],
            ['Sarana Ibadah',        'sarana',       'pie',      'Unit', 'Tahunan', 2],
            ['Data UMKM',            'ekonomi',      'bar',      'Unit', 'Tahunan', 0],
            ['Mata Pencaharian',     'ekonomi',      'pie',      'Jiwa', 'Tahunan', 1],
            ['Pendapatan Desa',      'ekonomi',      'line',     'Rp',   'Tahunan', 2],
        ];

        $katMap = ['kependudukan' => $katKependudukan, 'sarana' => $katSarana, 'ekonomi' => $katEkonomi];
        $tabelMap = [];

        foreach ($tabelDefs as [$judul, $kat, $tipe, $satuan, $periode, $urutan]) {
            $tabel = TabelStatistik::firstOrCreate(
                ['slug' => Str::slug($judul)],
                [
                    'judul_tabel'    => $judul,
                    'kategori_id'    => $katMap[$kat]->id,
                    'tipe_chart'     => $tipe,
                    'satuan_id'      => $satuanMap[$satuan]->id,
                    'periode_data'   => $periode,
                    'sumber_data'    => 'Disdukcapil / BPS 2024',
                    'baris_tabel_ke' => $urutan,
                    'is_active'      => true,
                    'user_id'        => $admin->id,
                ]
            );
            $tabelMap[$judul] = $tabel;
        }

        // ── 8. Sample input data ──────────────────────────────
        $t2024 = $tahunMap[2024];

        // Total Penduduk (number type)
        InputDataTabel::firstOrCreate(
            ['tabel_statistik_id' => $tabelMap['Total Penduduk']->id, 'tahun_id' => $t2024->id, 'label_baris' => null],
            ['kategori_id' => $katKependudukan->id, 'nilai' => 4872, 'is_active' => true, 'user_id' => $admin->id]
        );

        // Tingkat Pendidikan (bar chart)
        $pendidikan = ['Tidak Sekolah'=>120,'SD'=>980,'SMP'=>756,'SMA/SMK'=>1240,'D3'=>310,'S1'=>430,'S2/S3'=>80];
        foreach ($pendidikan as $label => $nilai) {
            InputDataTabel::firstOrCreate(
                ['tabel_statistik_id' => $tabelMap['Tingkat Pendidikan']->id, 'tahun_id' => $t2024->id, 'label_baris' => $label],
                ['kategori_id' => $katKependudukan->id, 'nilai' => $nilai, 'is_active' => true, 'user_id' => $admin->id]
            );
        }

        // Jenis Kelamin (doughnut)
        foreach (['Laki-laki' => 2480, 'Perempuan' => 2392] as $label => $nilai) {
            InputDataTabel::firstOrCreate(
                ['tabel_statistik_id' => $tabelMap['Jenis Kelamin']->id, 'tahun_id' => $t2024->id, 'label_baris' => $label],
                ['kategori_id' => $katKependudukan->id, 'nilai' => $nilai, 'is_active' => true, 'user_id' => $admin->id]
            );
        }

        // Pertumbuhan Penduduk (line — multi-year)
        $pertumbuhan = [2021=>4410, 2022=>4520, 2023=>4680, 2024=>4872];
        foreach ($pertumbuhan as $year => $nilai) {
            InputDataTabel::firstOrCreate(
                ['tabel_statistik_id' => $tabelMap['Pertumbuhan Penduduk']->id, 'tahun_id' => $tahunMap[$year]->id, 'label_baris' => 'Total'],
                ['kategori_id' => $katKependudukan->id, 'nilai' => $nilai, 'is_active' => true, 'user_id' => $admin->id]
            );
        }

        // ── 9. Kategori Spasial ───────────────────────────────
        $spasialKat = [];
        foreach ([
            ['Pemerintahan',  '#3B82F6'],
            ['Kesehatan',     '#10B981'],
            ['Pendidikan',    '#F59E0B'],
            ['Sarana Ibadah', '#8B5CF6'],
            ['Perbankan',     '#14B8A6'],
        ] as [$nama, $warna]) {
            $spasialKat[$nama] = KategoriSpasial::firstOrCreate(
                ['judul_kategori' => $nama],
                ['warna_marker' => $warna, 'user_id' => $admin->id, 'is_active' => true]
            );
        }

        // ── 10. Sample Spasial ────────────────────────────────
        $spasialData = [
            ['Kantor Desa Contoh',    'Pemerintahan',  'Jl. Desa No. 1',      -1.2379000, 116.8529000],
            ['Puskesmas Desa',        'Kesehatan',     'Jl. Kesehatan No. 5', -1.2400000, 116.8560000],
            ['SDN 01 Contoh',         'Pendidikan',    'Jl. Sekolah No. 3',   -1.2360000, 116.8510000],
            ['Masjid Jami Al-Ikhlas', 'Sarana Ibadah', 'Jl. Masjid No. 7',   -1.2390000, 116.8545000],
            ['BRI Unit Desa',         'Perbankan',     'Jl. Bank No. 2',      -1.2415000, 116.8570000],
        ];
        foreach ($spasialData as [$nama, $kat, $alamat, $lat, $lng]) {
            InputDataSpasial::firstOrCreate(
                ['nama_lokasi' => $nama, 'kategori_id' => $spasialKat[$kat]->id],
                ['alamat_lengkap' => $alamat, 'latitude' => $lat, 'longitude' => $lng,
                 'is_active' => true, 'user_id' => $admin->id]
            );
        }

        // ── 11. Kategori Publikasi ────────────────────────────
        $katPub = [];
        foreach (['Monografi', 'Laporan Keuangan', 'Profil Desa', 'Peraturan Desa', 'RKPD', 'Data Potensi'] as $k) {
            $katPub[$k] = KategoriPublikasi::firstOrCreate(['kategori' => $k]);
        }

        // ── 12. Sample Publikasi ──────────────────────────────
        InputPublikasi::firstOrCreate(
            ['slug' => 'monografi-desa-2024'],
            [
                'judul_publikasi'       => 'Monografi Desa Contoh 2024',
                'kategori_publikasi_id' => $katPub['Monografi']->id,
                'tahun_id'              => $t2024->id,
                'penulis'               => 'Sekretaris Desa',
                'file_publikasi'        => 'publikasi/sample.pdf',
                'download_count'        => 1234,
                'is_active'             => true,
                'user_id'               => $admin->id,
            ]
        );

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('   Email: admin@descan.go.id');
        $this->command->info('   Pass : password');
    }
}
