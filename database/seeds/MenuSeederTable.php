<?php

use Illuminate\Database\Seeder;
use bsm\Model\Pegawai;
use bsm\_web\Menu;

class MenuSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $_1 = '1';
        $_2 = '2';
        $_3 = '3';

        $menu_dashboard = new Menu();
        $menu_dashboard->title = "Dashboard";
        $menu_dashboard->icon  = "fa-dashboard";
        $menu_dashboard->url   = "dashboard"; //nama route
        $menu_dashboard->save();
        $menu_dashboard->status()->attach($_1);

        
        $menu_nasabah = new Menu();
        $menu_nasabah->title = "Nasabah";
        $menu_nasabah->icon  = "fa-users";
        $menu_nasabah->url   = "nasabah"; //nama route
        $menu_nasabah->save();
        $menu_nasabah->status()->attach($_1);
        
        $menu_transaksi = new Menu();
        $menu_transaksi->title = "Transaksi";
        $menu_transaksi->icon  = "fa-credit-card";
        $menu_transaksi->url   = "transaksi"; //nama route
        $menu_transaksi->save();
        $menu_transaksi->status()->attach($_1);
        
        $menu_koperasi = new Menu();
        $menu_koperasi->title = "Koperasi";
        $menu_koperasi->icon  = "fa-university";
        $menu_koperasi->url   = "koperasi"; //nama route
        $menu_koperasi->save();
        $menu_koperasi->status()->attach($_1);
        
        $menu_pegawai = new Menu();
        $menu_pegawai->title = "Pegawai";
        $menu_pegawai->icon  = "fa-gears";
        $menu_pegawai->url   = "pegawai"; //nama route
        $menu_pegawai->save();
        $menu_pegawai->status()->attach($_1);

        $menu_laporan = new Menu();
        $menu_laporan->title = "Laporan";
        $menu_laporan->icon  = "fa-file";
        $menu_laporan->url   = "laporan"; //nama route
        $menu_laporan->save();
        $menu_laporan->status()->attach($_1);


        $hamid = new Pegawai();
        $hamid->nama = 'Faisal Abdul Hamid';
        $hamid->username = 'faisal';
        $hamid->password = 'faisal';
        $hamid->status_id = '1';
        $hamid->save();
        //$hamid->remember_token = '1212';
    }
}

