<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_sku', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('goods_id')->comment('goods表主键');
            $table->index('goods_id');
            $table->char('title', '40')->comment('sku名称');
            $table->string('description')->default('')->comment('sku描述');
            $table->decimal('price', 10, 2)->comment('sku价格');
            $table->unsignedInteger('stock')->default(0)->comment('sku库存');
            $table->string('img')->default('')->comment('sku图片');
            $table->boolean('is_default')->default(false)->comment('是否默认选中：0否,1是');
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
        Schema::dropIfExists('goods_sku');
    }
}
