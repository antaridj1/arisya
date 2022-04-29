<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\DetailBarang;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function getBarangs(){
        $barangs = Barang::pluck('slug');
        //$nama = $barangs->map(function($barang,$key))
        return response()->json($barangs);
    }

    public function getJumlah(){
        $jumlah = DetailBarang::orderBy('barangs_id')->groupBy('barangs_id')->selectRaw('sum(jumlah) as sum')->pluck('sum');
        return response()->json($jumlah);
    }
}
