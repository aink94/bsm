<?php

use Illuminate\Database\Seeder;
use bsm\_web\Menu;
use bsm\_web\Status;

class StatusSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_admin = new Status();
        $status_admin->status = "ADMIN";
        $status_admin->save();

        $status_pegawai = new Status();
        $status_pegawai->status = "PEGAWAI";
        $status_pegawai->save();

        $status_manager = new Status();
        $status_manager->status = "MANAGER";
        $status_manager->save();

        //===============================
        
    }
}
