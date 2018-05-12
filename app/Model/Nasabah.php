<?php

namespace bsm\Model;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $table = 'nasabah';

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'nasabah_id');
    }
}
