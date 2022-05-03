<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $year = Carbon::now()->year;
        $pengeluarans = Pengeluaran::selectRaw('year(created_at) year, monthname(created_at) month, sum(biaya)/1000000 as sum')
                    ->whereYear('created_at',$year)
                    ->groupBy('year','month')
                    ->orderBy('month','DESC')
                    ->get()->toArray();
                    
        $pemasukans = Penjualan::selectRaw('year(created_at) year, monthname(created_at) month, sum(total_harga)/1000000 as sum')
                    ->whereYear('created_at',$year)
                    ->groupBy('year','month')
                    ->orderBy('month','DESC')
                    ->get()->toArray();
                    
        $data_pengeluaran = [];
        $data_pemasukan = [];

        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($pengeluarans, 'month'));
            $data = $key === false ? 0 : $pengeluarans[$key]['sum'];
            array_push($data_pengeluaran, $data);
        }

        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($pemasukans, 'month'));

            $data = $key === false ? 0 : $pemasukans[$key]['sum'];
            array_push($data_pemasukan, $data);
        }

        $profits = collect();

        foreach ($data_pemasukan as $key => $value) {
            if(array_key_exists($key,$data_pemasukan) && array_key_exists($key,$data_pengeluaran)){
                $profit = $data_pemasukan[$key] - $data_pengeluaran[$key];
            }$profits->push($profit);
        }
        
        
        return view('dashboard');
    }

    public function getBarangs(){
        $barangs = Barang::pluck('slug');
        $jumlah = DetailBarang::orderBy('barangs_id')->groupBy('barangs_id')->selectRaw('sum(jumlah) as sum')->pluck('sum');
        return response()->json(array($barangs,$jumlah));
    }

    public function getProfit(){
        $year = Carbon::now()->year;
        $pengeluarans = Pengeluaran::selectRaw('year(created_at) year, monthname(created_at) month, sum(biaya)/1000000 as sum')
                    ->whereYear('created_at',$year)
                    ->groupBy('year','month')
                    ->orderBy('month','DESC')
                    ->get()->toArray();
    
        $pemasukans = Penjualan::selectRaw('year(created_at) year, monthname(created_at) month, sum(total_harga)/1000000 as sum')
                    ->whereYear('created_at',$year)
                    ->groupBy('year','month')
                    ->orderBy('month','DESC')
                    ->get()->toArray();

        $data_pengeluaran = [];
        $data_pemasukan = [];

        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($pengeluarans, 'month'));
            $data = $key === false ? 0 : $pengeluarans[$key]['sum'];
            array_push($data_pengeluaran, $data);
        }

        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($pemasukans, 'month'));
            $data = $key === false ? 0 : $pemasukans[$key]['sum'];
            array_push($data_pemasukan, $data);
        }

        $profit = [];

        foreach ($data_pemasukan as $key => $value) {
            if(array_key_exists($key,$data_pemasukan) && array_key_exists($key,$data_pengeluaran)){
                $profit[$key] = $data_pengeluaran[$key] - $data_pemasukan[$key];
            }
            
        }
        $profits = [];
        array_push($profits,$profit);

        return response()->json($profits);
    }
}
