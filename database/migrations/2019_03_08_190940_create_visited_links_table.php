<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitedLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visited_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visited_id')->unsigned();
            $table->integer('view_request_id')->unsigned();
            $table->integer('ads_id')->unsigned();
            $table->tinyInteger('type');
            $table->integer('price');
            $table->tinyInteger('visit_type');
            $table->double('referrer_price');
            $table->string('ip');
            $table->string('os');
            $table->string('browser');

            $table->timestamps();


            $table->foreign('visited_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('view_request_id')
                ->references('id')
                ->on('view_requests')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ads_id')
                ->references('id')
                ->on('ads')
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
        Schema::dropIfExists('visited_links');
    }
}
