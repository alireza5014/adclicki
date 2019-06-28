<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitedWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('visited_websites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('view_request_id')->unsigned();
            $table->integer('ads_id')->unsigned();
            $table->enum('type', ['banner', 'popup', 'pop_box']);

            $table->integer('price');

            $table->double('referrer_price');

            $table->string('ip');
            $table->string('os');
            $table->string('browser');

            $table->timestamps();


            $table->foreign('website_id')
                ->references('id')
                ->on('websites')
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
        Schema::dropIfExists('visited_websites');
    }
}
