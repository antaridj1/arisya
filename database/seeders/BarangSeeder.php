<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'nama'=>'Jati',
            'ukuran'=>'6x12x2',
            'harga_satuan'=>'120000',
            'harga_kubik'=>'8000000',
            'jumlah_per_kubik'=>'70',
            'stok'=>'1200',
            'keterangan'=>'tes'
        ]);
    }
}
