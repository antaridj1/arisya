<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $barangs = Barang::all();
        return view('penjualan.create',compact('barangs'));
    }

    public function getBarang()
    {
        $barangs = Barang::all();
        return response()->json($barangs);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqBarang = collect($request->barang);
        $reqJumlah = collect($request->jumlah);
        $reqSatuan = collect($request->satuan);
        $index = count($reqBarang);

        $user_id = Auth::id();

        $penjualan = Penjualan::create([
            'nama'=> $request->nama,
            'telp'=> $request->telp,
            'alamat'=> $request->alamat,
            'total_harga'=>$request->total_harga,
            'karyawans_id' => $user_id
        ]);

        for($i=0;$i<$index;$i++){
            DetailBarang::create([
                'barangs_id' => $reqBarang[$i],
                'penjualans_id' => $penjualan->id,
                'jumlah' => $reqJumlah[$i],
                'satuan' => $reqSatuan[$i],
            ]);

            $stok = Barang::where('id',$reqBarang[$i])->value('stok');
            if ($reqSatuan[$i] == "Paket"){
                $jml_paket = Barang::where('id',$reqBarang[$i])->value('jumlah_paket');
                $reqJumlah[$i] = $reqJumlah[$i] * $jml_paket;
            }
            $sisa = $stok - $reqJumlah[$i];
            
            Barang::where('id',$reqBarang[$i])->update([
                'stok' => $sisa
            ]);
        }

        return redirect('penjualan/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}
