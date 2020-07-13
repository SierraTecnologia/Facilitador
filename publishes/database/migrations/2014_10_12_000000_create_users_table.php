<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'roles', function (Blueprint $table) {

                // Set the storage engine and primary key
                $table->engine = 'InnoDB';
                $table->increments('id');

                // Ordinary columns
                $table->string('name')->unique();
                $table->boolean('is_default')->unsigned()->default(0);

                // Automatic columns
                $table->timestamps();
            }
        );
        Schema::create(
            'users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('cpf')->nullable();
                $table->string('email')->nullable();
                $table->string('username')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->string('token');
                $table->string('language_code')->nullable();
                $table->string('region_code')->nullable();

                $table->integer('role_id')->unsigned();

                $table->timestamps();
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}
