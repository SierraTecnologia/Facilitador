<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'menus', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('slug')->default('main');
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::create(
            'menu_items', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('menu_id')->nullable();
                $table->string('title');
                $table->string('url');
                $table->string('target')->default('_self');
                $table->string('icon_class')->nullable();
                $table->string('color')->nullable();
                $table->integer('parent_id')->nullable();
                $table->integer('order');
                $table->timestamps();

                $table->string('language_code');
                $table->string('country_code')->nullable();
                $table->foreign('language_code')->references('code')->on('languages');
                $table->foreign('country_code')->references('code')->on('countries');
                
                $table->softDeletes();
            }
        );

        Schema::table(
            'menu_items', function (Blueprint $table) {
                $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_items');
        Schema::drop('menus');
    }
}
