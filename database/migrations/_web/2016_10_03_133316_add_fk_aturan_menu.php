<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkAturanMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aturan_menu', function (Blueprint $table) {
            $table->foreign('status_id')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');
            $table->foreign('menu_id')
                ->references('id')
                ->on('menu')
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
        Schema::table('aturan_menu', function (Blueprint $table) {
            $table->dropForeign('aturan_menu_menu_id_foreign');
            $table->dropForeign('aturan_menu_status_id_foreign');
        });
    }
}
