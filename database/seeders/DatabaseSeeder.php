<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TransaksiSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            RakSeeder::class,
            PenerbitSeeder::class,
            BukuSeeder::class,
            TransaksiSeeder::class,
            // PeminjamanSeeder::class,
        ]);
    }
}
