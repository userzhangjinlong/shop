<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodtypeToGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->unsignedTinyInteger('sales')->default(0)->comment('0上架, 1下架');
            $table->unsignedTinyInteger('hot')->default(0)->comment('0非热销, 1热销');
            $table->unsignedTinyInteger('best_good')->default(0)->comment('0非精品, 1精品');
            $table->unsignedTinyInteger('spike')->default(0)->comment('0关闭, 1开启 (秒杀)');
            $table->decimal('spike_price')->default(0.00)->comment('秒杀价格');
            $table->timestamp('spike_b_time')->nullable()->comment('秒杀开始时间');
            $table->timestamp('spike_e_time')->nullable()->comment('秒杀结束时间');
            $table->unsignedTinyInteger('group_buy')->default(0)->comment('0关闭, 1开启 (拼团)');
            $table->unsignedInteger('broup_buy_num')->default(0)->comment('发起拼团人数');
            $table->decimal('group_buy_price')->default(0.00)->comment('拼团价格');
            $table->decimal('group_buy_s_price')->default(0.00)->comment('拼团发起价格');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
            //
        });
    }
}
