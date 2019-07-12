<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributesToGoodsSku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_sku', function (Blueprint $table) {
            $table->string('attributes')->default('')->after('is_default')->comment('attributes属性表id多个拼接');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_sku', function (Blueprint $table) {
            $table->dropColumn('attributes');
        });
    }
}
