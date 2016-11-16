<?php

namespace bsm\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use bsm\Model\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
    	return view('transaksi');
    }

    public function getAllTransaksiPerDay(Request $request, Transaksi $transaksi)
    {
        if($request->wantsJson())
        {
            //$id = Auth::user()->id;
            $transaksi = $transaksi->user()->oneDay()->orderBy('tanggal', 'asc')->get();
            return fractal()
                ->collection($transaksi)
                ->transformWith(function (Transaksi $transaksi){
                    setlocale(LC_TIME, config('app.locale'));
                    $dt = Carbon::parse($transaksi->tanggal);
                    return [  
                        'nasabah' => $transaksi->nasabah->nama, 
                        //'tanggal' => Carbon::createFromDate($transaksi->tanggal)->diffForHuman(),
                        'tanggal' => $dt->formatLocalized('%A, %d %B %Y - Jam %H:%M:%S'),
                        'jumlah' => $transaksi->jumlah,
                        'jt' => $transaksi->jenis_transaksi->nama, 
                    ];
                })
                ->toArray();
        }
        else
        {
            return 'Forbidden';
        }
    }

    public function simpan()
    {

    }

    public function ambil()
    {
    	
    }
    
}
	