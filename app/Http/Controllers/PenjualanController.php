<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        if(Auth::user()->isOwner == true){
            $penjualans = Penjualan::orderBy('created_at','DESC')->filter(request(['status','search']))->paginate(10)->withQueryString();
        }else{
            $user_id = Auth::id();
            $penjualans = Penjualan::orderBy('created_at','DESC')->where('karyawans_id',$user_id)->filter(request(['status','search']))->paginate(10)->withQueryString();
        }
        
        return view('penjualan.index',compact('penjualans'));
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
            if ($reqSatuan[$i] == "Paket"){
                $jml_paket = Barang::where('id',$reqBarang[$i])->value('jumlah_paket');
                $reqJumlah[$i] = $reqJumlah[$i] * $jml_paket;
            }
            DetailBarang::create([
                'barangs_id' => $reqBarang[$i],
                'penjualans_id' => $penjualan->id,
                'jumlah' => $reqJumlah[$i],
                'satuan' => $reqSatuan[$i],
            ]);

            $stok = Barang::where('id',$reqBarang[$i])->value('stok');
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Penjualan $penjualan)
    {
        Penjualan::where('id',$penjualan->id)->update([
            'status' => 1
        ]);
        return redirect('penjualan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        try{
            $penjualan->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menghapus data penjualan');
        }
        return redirect('penjualan')->withInput()->with('success', 'Berhasil menghapus data penjualan');
    }

    public function cetak(){
        $penjualas = Penjualan::all();
        return view('penjualan.cetak',compact('penjualans'));
    }
}
