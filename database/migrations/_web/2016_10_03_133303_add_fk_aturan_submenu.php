<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkAturanSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aturan_submenu', function (Blueprint $table) {
            $table->foreign('status_id')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');
            $table->foreign('submenu_id')
                ->references('id')
                ->on('submenu')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aturan_submenu', function (Blueprint $table) {
            //$table->dropForeign('aturan_submenu_status_id_foreign');
            $table->dropForeign('aturan_submenu_submenu_id_foreign');
        });
    }
}
