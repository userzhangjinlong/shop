<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cate_id');
            $table->index('cate_id');
            $table->char('goods_name', 20);
            $table->string('desc')->default('');
            $table->string('tags', 255)->default('');
            $table->decimal('original_price', 10, 2)->default(0.00);
            $table->decimal('present_price', 10, 2)->default(0.00);
            $table->string('thumb_img');
            $table->text('carousel_img');
            $table->unsignedInteger('stock')->default(0);
            $table->decimal('postage', 10, 2)->default(0.00);
            $table->unsignedTinyInteger('post_free')->default(0);//0免邮 1不免邮
            $table->decimal('full_price', 10, 2)->default(0.00);
            $table->text('ensure');
            $table->text('goods_detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
