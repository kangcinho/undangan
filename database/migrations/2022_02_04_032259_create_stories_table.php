<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("invite_id");
            $table->string('kisah_cinta_tahun')->nullable();
            $table->string('kisah_cinta_judul')->nullable();
            $table->string('kisah_cinta_isi')->nullable();
            $table->string('kisah_cinta_foto')->nullable();
            
            $table->foreign('invite_id')->references('id')->on('invites')->onDelete('cascade');;
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
        //
    }
}
