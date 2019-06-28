<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('ticket_id');
            $table->string('subject');
            $table->text('message');
            $table->string('ip');
            $table->string('image_path');
            $table->tinyInteger('status');


            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });



        Schema::create('tickets_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned();


            $table->text('message');
            $table->string('ip');
            $table->string('image_path');
            $table->tinyInteger('sender_type'); // 1 => admin   0=> user


            $table->timestamps();


            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('tickets_answers');
    }
}
