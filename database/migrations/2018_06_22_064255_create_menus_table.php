<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('父级菜单');
            $table->string('name', 25)->default('')->comment('菜单名');
            $table->string('url', 50)->default('')->comment('菜单链接');
            $table->string('component', 50)->default('')->comment('组件');
            $table->string('alias', 50)->default('')->comment('组件名称');
            $table->string('class', 50)->default('')->comment('类名');
            $table->integer('sort')->default(1)->comment('排序');
            $table->string('icon', 50)->default('')->comment('菜单图标');
            $table->tinyInteger('status')->default(1)->comment('状态');
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
        Schema::dropIfExists('menus');
    }
}
