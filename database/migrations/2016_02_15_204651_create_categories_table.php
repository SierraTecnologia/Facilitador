<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing categories
        Schema::create(
            'categories', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned()->nullable()->default(null);
                $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
                $table->integer('order')->default(1);
                $table->string('title');
                $table->string('slug')->unique();

                $table->string('language_code');
                $table->string('country_code')->nullable();
                $table->foreign('language_code')->references('code')->on('languages');
                $table->foreign('country_code')->references('code')->on('countries');
                $table->timestamps();
                $table->softDeletes();
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
        Schema::drop('categories');
    }
}