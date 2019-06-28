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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('fname');
            $table->string('lname');

            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->integer('code_melli')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('image_path');
            $table->tinyInteger('type')->default(0);
            $table->string('device')->default('web');
            $table->tinyInteger('is_admin')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
