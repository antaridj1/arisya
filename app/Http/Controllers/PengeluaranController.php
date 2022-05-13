<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Exception;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\PDF;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('created_at','DESC')->cari(request(['search']))->paginate(10)->withQueryString();
        return view('pengeluaran.index',compact('pengeluarans'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama'=> 'required',
                'biaya'=>'required|numeric|min:1',
            ]);

            Pengeluaran::create($request->all());

        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan pengeluaran');
        }
        return redirect('pengeluaran')->withInput()->with('success', 'Berhasil menambahkan pengeluaran');
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        try{
            $request->validate([
                'nama'=> 'required',
                'biaya'=>'required|numeric|min:1'
            ]);

            $pengeluaran->update($request->all());

        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal mengedit pengeluaran');
        }
        return redirect('pengeluaran')->withInput()->with('success', 'Berhasil mengedit pengeluaran');
    }

    public function destroy(pengeluaran $pengeluaran)
    {
        try{
            $pengeluaran->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menghapus pengeluaran');
        }
        return redirect('pengeluaran')->withInput()->with('success', 'Berhasil menghapus pengeluaran');
    }

    public function cetak(){
        $pengeluarans = Pengeluaran::all();
        return view('pengeluaran.cetak',compact('pengeluarans'));
    }
}
