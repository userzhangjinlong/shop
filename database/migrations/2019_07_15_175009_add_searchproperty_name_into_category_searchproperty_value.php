<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchpropertyNameIntoCategorySearchpropertyValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_searchproperty_value', function (Blueprint $table) {
            $table->char('searchproperty_name', 20)->comment('category_searchproperty表主键名称')->after('searchproperty_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_searchproperty_value', function (Blueprint $table) {
            $table->dropColumn('searchproperty_name');
        });
    }
}
