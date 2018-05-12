<?php

use bsm\Model\JenisTransaksi;
use Illuminate\Database\Seeder;

class JenisTransaksiSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jt_1 = new JenisTransaksi();
        $jt_1->nama = 'Penyimpanan';
        $jt_1->save();

        $jt_1 = new JenisTransaksi();
        $jt_1->nama = 'Pengambilan';
        $jt_1->save();

        $jt_1 = new JenisTransaksi();
        $jt_1->nama = 'Pembelajaan';
        $jt_1->save();
    }
}
