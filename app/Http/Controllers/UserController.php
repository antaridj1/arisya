<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = User::where('isOwner',false)->cari(request(['search']))->paginate(10)->withQueryString();
        return view('karyawan.index',compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
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
                'telp'=>'required',
                'alamat'=>'required',
            ]);
            
            $username = User::getUsername();

            User::create([
                'nama'=>$request->nama,
                'telp'=>$request->telp,
                'alamat'=>$request->alamat,
                'username'=>$username,
                'password'=>bcrypt('karyawan123')
            ]);

        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan karyawan');
        }
        return redirect('karyawan')->withInput()->with('success', 'Berhasil menambahkan karyawan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $karyawan)
    {
        return view('karyawan.edit',compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try{
            $request->validate([
                'nama'=> 'required',
                'telp'=>'required',
                'username'=>'required',
                'alamat'=>'required',
            ]);

            $user->update($request->all());

        }catch(Exception $e){
            Log::info($e->getMessage());
            return back()->withInput()->with('error', 'Gagal mengedit user');
        }
        return redirect('profil')->withInput()->with('success', 'Berhasil mengedit user');
    }

    public function updateStatus(Request $request, User $user)
    {
        if($user->status == true){
            $user->update(['status'=>false]);
        }else{
            $user->update(['status'=>true]);
        }
        return redirect('karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profil(){
        $user_id = Auth::id();
        $users = User::where('id',$user_id)->get();
        return view('profil',compact('users'));
    }

    public function updatePass(Request $request){
        $user_id = Auth::id();
        $password = User::where('id',$user_id)->value('password');

        $request->validate([
            'password_baru'=>'required|min:3|max:255',
            'password_lama'=>'required|min:3|max:255',
            'konfirmasi'=>'required||min:3|max:255',
        ]);
        
        if(password_verify($request->password_lama, $password) && 
        $request->password_baru == $request->konfirmasi){
            User::where('id',$user_id)->update([
                'password'=>bcrypt($request->password_baru)
            ]);
        }else{
            return back()->with('update_gagal','error');
        }
        return redirect('profil')->with('update_berhasil','success');
    }
}
