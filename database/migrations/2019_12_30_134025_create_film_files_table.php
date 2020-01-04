<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('film_id')->unsigned();
            $table->string('quality');
            $table->string('google_drive_id');
            $table->text('google_drive_link');
            $table->text('link');
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
        Schema::dropIfExists('film_files');
    }
}
