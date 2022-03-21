<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ukuran',
        'harga_satuan',
        'harga_kubik',
        'jumlah_per_kubik',
        'stok',
        'keterangan'
    ];

    public function scopeCari($query, array $cari){
        $query->when($cari['search'] ?? false, function($query, $search) {
            return $query->where('nama','like','%'.$search.'%')
                        ->orWhere('ukuran','like','%'.$search.'%')
                        ->orWhere('harga_satuan','like','%'.$search.'%')
                        ->orWhere('harga_kubik','like','%'.$search.'%')
                        ->orWhere('jumlah_per_kubik','like','%'.$search.'%');
        });
    }
}
