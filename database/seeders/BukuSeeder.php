<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'judul' => '7 IN 1 Pemrograman Web untuk Pemula',
            'slug' => Str::slug('7 IN 1 Pemrograman Web untuk Pemula'),
            'sampul' => 'buku/7_IN_1_Pemrograman_Web_untuk_Pemula.jpg',
            'penulis' => 'Rohi Abdulloh',
            'penerbit_id' => 5,
            'kategori_id' => 2,
            'rak_id' => 2,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'Analisis dan Desain Sistem Informasi',
            'slug' => Str::slug('Analisis dan Desain Sistem Informasi'),
            'sampul' => 'buku/Analisis_dan_Desain_Sistem_Informasi.jpg',
            'penulis' => 'Al-Bahra Bin Ladjamudin',
            'penerbit_id' => 6,
            'kategori_id' => 2,
            'rak_id' => 3,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'Rekayasa Perangkat Lunak Terstruktur dan Berorientasi Objek',
            'slug' => Str::slug('Rekayasa Perangkat Lunak Terstruktur dan Berorientasi Objek'),
            'sampul' => 'buku/Rekayasa_Perangkat_Lunak_Terstruktur_dan_Berorientasi_Objek.jpg',
            'penulis' => 'Rosa A.S. & M. Shalahuddin',
            'penerbit_id' => 4,
            'kategori_id' => 2,
            'rak_id' => 4,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'Buku Sakti Pemrograman Web',
            'slug' => Str::slug('Buku Sakti Pemrograman Web'),
            'sampul' => 'buku/Buku_Sakti_Pemrograman_Web.jpg',
            'penulis' => 'Didik Setiawan',
            'penerbit_id' => 3,
            'kategori_id' => 2,
            'rak_id' => 5,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'Pembahasan Lengkap Tentang Tata Bahasa Inggris',
            'slug' => Str::slug('Pembahasan Lengkap Tentang Tata Bahasa Inggris'),
            'sampul' => 'buku/Pembahasan_Lengkap_Tentang_Tata_Bahasa_Inggris.jpg',
            'penulis' => 'John S. Hartanto',
            'penerbit_id' => 3,
            'kategori_id' => 3,
            'rak_id' => 7,
            'stok' => 10
        ]);
    }
}
