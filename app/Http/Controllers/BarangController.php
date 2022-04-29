<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Barang::groupBy('ukuran')->selectRaw('sum(harga_satuan) as sum, ukuran')->pluck('sum','ukuran'));
        dd(Barang::selectRaw('MONTH(created_at) as month')->get());
        $barangs = Barang::cari(request(['search']))->paginate(10)->withQueryString();
        return view('barang.index',compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama'=> 'required',
                'harga_satuan'=>'required',
                'harga_paket'=>'required',
                'jumlah_paket'=>'required',
                'stok'=>'required',
                'keterangan'=>'required'
            ]);

            Barang::create($request->all());

        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan barang');
        }
        return redirect('barang')->withInput()->with('success', 'Berhasil menambahkan barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        try{
            $request->validate([
                'nama'=> 'required',
                'harga_satuan'=>'required',
                'harga_paket'=>'required',
                'jumlah_paket'=>'required',
                'stok'=>'required',
                'keterangan'=>'required'
            ]);

            $barang->update($request->all());

        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal mengedit barang');
        }
        return redirect('barang')->withInput()->with('success', 'Berhasil mengedit barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        try{
            $barang->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menghapus barang');
        }
        return redirect('barang')->withInput()->with('success', 'Berhasil menghapus barang');
    }
}
