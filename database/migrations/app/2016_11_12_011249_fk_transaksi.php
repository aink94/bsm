<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('pegawai_id')->unsigned()->nullable();
            $table->foreign('pegawai_id')->references('id')->on('pegawai');

            $table->integer('jenis_transaksi_id')->unsigned();
            $table->foreign('jenis_transaksi_id')->references('id')->on('jenis_transaksi');

            $table->integer('nasabah_id')->unsigned();
            $table->foreign('nasabah_id')->references('id')->on('nasabah');

            $table->integer('koperasi_id')->unsigned();
            $table->foreign('koperasi_id')->references('id')->on('koperasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign('transaksi_pegawai_id_foreign');
            $table->dropForeign('transaksi_jenis_transaksi_id_foreign');
            $table->dropForeign('transaksi_nasabah_id_foreign');
            $table->dropForeign('transaksi_koperasi_id_foreign');
        });
    }
}
