<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_searches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ads_id')->unsigned();

            $table->string('keyword');
            $table->integer('page_number');


            $table->foreign('ads_id')
                ->references('id')
                ->on('ads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('google_searches');
    }
}
