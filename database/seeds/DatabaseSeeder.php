<?php

use bsm\Model\Koperasi;
use bsm\Model\Nasabah;
use bsm\Model\Pegawai;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JenisTransaksiSeederTable::class);
        $this->call(KoperasiSeederTable::class);
        $this->call(StatusSeederTable::class);
        $this->call(MenuSeederTable::class);
        //$faker = Faker\Factory::create();

        factory(Pegawai::class, 10)->create();
        factory(Nasabah::class, 300)->create();
        factory(Koperasi::class, 300)->create();
    }
}
