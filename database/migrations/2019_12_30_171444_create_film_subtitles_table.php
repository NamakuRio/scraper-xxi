<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmSubtitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_subtitles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('film_id')->unsigned();
            $table->string('label');
            $table->string('file');
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_subtitles');
    }
}
