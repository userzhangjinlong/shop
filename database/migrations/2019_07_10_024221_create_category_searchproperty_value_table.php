<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySearchpropertyValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_searchproperty_value', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cate_id')->comment('分类表主键');
            $table->index('cate_id');
            $table->char('cate_name', 20)->comment('分类表名称');
            $table->unsignedInteger('searchproperty_id')->comment('属性表主键');
            $table->index('searchproperty_id');
            $table->char('searchproperty_value', 40)->comment('属性值前端展示使用');
            $table->char('search_val', 40)->comment('搜索值用于后端搜索使用');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
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
        Schema::dropIfExists('category_searchproperty_value');
    }
}
