<?php

use bsm\Model\Koperasi;
use Illuminate\Database\Seeder;

class KoperasiSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $koperasi = new Koperasi();
        $koperasi->nama = 'Minimartket Manahijul Huda';
        $koperasi->date_open = '2016-10-11';
        $koperasi->date_close = '2017-10-11';
        $koperasi->key = bcrypt('minimart');
        $koperasi->token = bcrypt('koperasi');
        $koperasi->save();
    }
}

// consumerKey <- "XXX"
// consumerSecret <- "XXX"
// accessToken <- "XXX"
// accessTokenSecret <- "XXX"
