<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'name' => 'TPS'
            ],
            [
                'name' => 'Literasi Bahasa Indonesia'
            ],
            [
                'name' => 'Literasi Bahasa Inggris'
            ],
            [
                'name' => 'Penalaran Matematika'
            ],
        ]);
    }
}
