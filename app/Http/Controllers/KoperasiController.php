<?php

namespace bsm\Http\Controllers;

use bsm\Model\Koperasi;
use Illuminate\Http\Request;

class KoperasiController extends Controller
{
    public function index()
    {
        return view('koperasi');
    }

    public function getAllKoperasi(Koperasi $koperasi, Request $request)
    {
        if ($request->ajax()) {
            $koperasi = $koperasi->all();

            return fractal()
                ->collection($koperasi)
                ->transformWith(function (Koperasi $koperasi) {
                    return [
                        'id'         => (int) $koperasi->id,
                        'nama'       => $koperasi->nama,
                        'date_open'  => $koperasi->date_open,
                        'date_close' => $koperasi->date_close,
                        'action'     => $koperasi->action,
                    ];
                })->toArray();
        } else {
            return 'Tidak Memiliki Akses';
        }
    }

    public function tambah(Request $request, Koperasi $koperasi)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'nama'  => 'required',
                'token' => 'required',
                'key'   => 'required',
            ]);

            $koperasi = $koperasi->create([
                'nama'  => $request->nama,
                'token' => $request->token,
                'key'   => $request->key,
            ]);

            return response()->json([
                    'title'  => 'Berhasil Ditambahkan',
                    'message'=> 'Berhasil ditambahkan dalam database', ],
                200);
        } else {
            return 'Tidak Memiliki Akses';
        }
    }

    public function ubah(Request $request, Koperasi $koperasi)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'nama'  => 'required',
                //'token' => $request->token,
                //'key'   => $request->key,
            ]);

            $koperasi = $koperasi->findOrFail($request->id);
            $koperasi->nama = $request->nama;
            $koperasi->token = $request->token;
            $koperasi->key = $request->key;
            $koperasi->save();

            return response()->json([
                    'title'  => 'Berhasil Diubah',
                    'message'=> 'Berhasil diubah dalam database', ],
                200);
        } else {
            return 'Tidak Memiliki Akses';
        }
    }

    public function hapus(Request $request, Koperasi $koperasi)
    {
        if ($request->wantsJson()) {
            $koperasi = $koperasi->findOrFail($request->id);
            $koperasi->delete();

            return response()->json([
                'title'  => 'Berhasil Dihapus',
                'message'=> 'Berhasil dihapus dalam database', ],
            200);
        } else {
            return 'Tidak Memiliki Akses';
        }
    }
}
