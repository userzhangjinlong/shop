<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttrValColumToGoodsAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_attributes', function (Blueprint $table) {
            $table->char('attr_val', 40)->default('')->after('hasmany')->comment('不可选属性值');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_attributes', function (Blueprint $table) {
            $table->dropColumn('attr_val');
        });
    }
}
