<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'telp',
        'alamat',
        'total_harga',
        'karyawans_id',
        'status'
    ];

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawans_id');
    }

    public function detail_barang()
    {
        return $this->hasMany(DetailBarang::class, 'penjualans_id');
    }

    public function scopeFilter($query, array $filter){
        $query->when($filter['search'] ?? false, function($query, $search) {
            return $query->where('nama','like','%'.$search.'%')
                        ->orWhere('alamat','like','%'.$search.'%')
                        ->orWhere('telp','like','%'.$search.'%');          
        });

        $query->when($filter['status'] ?? false, function($query, $status){
            return $query->where('status',$status);
        });
    }
}
