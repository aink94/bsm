<?php

namespace bsm\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $timestamps = false;

    public function koperasi()
    {
        return $this->belongsTo(Koperasi::class, 'koperasi_id');
    }

    public function jenis_transaksi()
    {
        return $this->belongsTo(JenisTransaksi::class, 'jenis_transaksi_id');
    }

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function scopeUser($query)
    {
        return $query->where('pegawai_id', '=', Auth::user()->id);
    }

    public function scopeOneDay($query)
    {
        return $query->where('tanggal', 'LIKE', Carbon::now()->format('Y-m-d').'%');
    }
}
