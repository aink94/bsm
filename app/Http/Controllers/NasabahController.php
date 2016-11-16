<?php

namespace bsm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use bsm\Model\Nasabah;

class NasabahController extends Controller
{
    public function index()
    {
    	return view('nasabah');
    }

    public function getAllNasabah(Nasabah $nasabah, Request $request)
    {

    	if($request->ajax()){
	    	$nasabah = $nasabah->orderBy('nama', 'asc')->get();
	    	return fractal()
	    		->collection($nasabah)
	    		->transformWith(function(Nasabah $nas){
	    			return [
	    				//'id' => (int) $nas->id,
	    				'nis' => $nas->nis,
	    				'nama' => $nas->nama,
	    				'kartu' => $nas->status_kartu
	    			];

	    		})->toArray();
    	}else{
    		return 'Tidak Memiliki Akses';
    	}
    }

    public function tambah(Request $request, Nasabah $nasabah)
    {
    	if($request->ajax()){
            $this->validate($request, [
                'nis'          => 'required',
                'nama'         => 'required',
                'status_kartu' => 'required'
            ]);

            $nasabah = $nasabah->create([]);
    	}else{
    		return 'Tidak Memiliki Akses';
    	}
    }

    public function ubah(Request $request, Nasabah $nasabah)
    {
        if($request->wantsJson())
        {

        }
    }

    public function hapus(Request $request, Nasabah $nasabah)
    {
        if($request->wantsJson())
        {
            
        }
    }

}
