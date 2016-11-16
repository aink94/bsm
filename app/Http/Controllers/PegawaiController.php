<?php

namespace bsm\Http\Controllers;

use Illuminate\Http\Request;
use bsm\Model\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
    	return view('pegawai');
    }


    public function getAllPegawai(Pegawai $pegawai, Request $request)
    {

    	if($request->ajax()){
	    	$pegawai = $pegawai->all();
	    	return fractal()
	    		->collection($pegawai)
	    		->transformWith(function(Pegawai $pegawai){
	    			return [
                        'id'       => (int) $pegawai->id,
                        'nama'     => $pegawai->nama,
                        'username' => $pegawai->username,
                        'password' => $pegawai->password,
                        'status'   => $pegawai->status->id,
                        'act'      => $pegawai->action,
	    			];
	    		})->toArray();
    	}else{
    		return 'Tidak Memiliki Akses';
    	}
    }

    public function tambah(Request $request, Pegawai $pegawai)
    {
    	if($request->ajax()){
    		$this->validate($request, [
                'nama'      => 'required',
                'username'  => 'required',
                'password'  => 'required',
                'status'    => 'required',
            ]);

            $pegawai = $pegawai->create([
                'nama'      => $request->nama,
                'username'  => $request->username,
                'password'  => $request->password,
                'status_id' => $request->status
            ]);
            return response()->json([
                    'title'=>'success', 
                    'message'=>'Berhasil menambahkan ke database'], 
                200);
    	}else{
    		return 'Tidak Memiliki Akses';
    	}
    }

    public function ubah(Request $request, Pegawai $pegawai)
    {
        if($request->ajax()){
            $this->validate($request, [
                'nama'      => 'required',
                'username'  => 'required',
                'status'    => 'required',
            ]);
            $pegawai            = $pegawai->findOrFail($request->id);
            $pegawai->nama      = $request->nama;
            $pegawai->username  = $request->username;
            $pegawai->password  = $request->password;
            $pegawai->status_id = $request->status;
            $pegawai->save();

            return response()->json([
                    'title'=>'Berhasil Diubah', 
                    'message'=>'Berhasil diubah dalam database'], 
                200);
        }else{
            return 'Tidak Memiliki Akses';
        }
    }

    public function hapus(Request $request, Pegawai $pegawai)
    {
        if($request->wantsJson())
        {
            $pegawai = $pegawai->findOrFail($request->id);
            $pegawai->delete();
            return Response()->json([
                    'title' => 'Berhasil Dihapus',
                    'message' => 'Berhasil dihapus dalam database'
                ], 200);
        }
    }
}
