<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->string("url_invite")->unique();
            $table->unsignedBigInteger("tema_id");
            
            $table->string('foto_header')->nullable();

            $table->string('putra_ke_suami')->nullable();
            $table->string('nama_suami')->nullable();
            $table->string('nama_panggilan_suami')->nullable();
            $table->string('foto_suami')->nullable();
            $table->string('nama_suami_initial')->nullable();
            $table->string('putri_ke_istri')->nullable();
            $table->string('nama_istri')->nullable();
            $table->string('nama_panggilan_istri')->nullable();
            $table->string('foto_istri')->nullable();
            $table->string('nama_istri_initial')->nullable();
            $table->date('tanggal_nikah')->nullable();
            $table->text('kata_mutiara')->nullable();
            $table->string('nama_suami_ortu_bapak')->nullable();
            $table->string('nama_suami_ortu_ibu')->nullable();
            $table->string('nama_istri_ortu_bapak')->nullable();
            $table->string('nama_istri_ortu_ibu')->nullable();

            $table->string('pepatah_foto')->nullable();
            $table->string('pepatah_kata')->nullable();
            $table->string('pepatah_author')->nullable();
            

            $table->text('galeri_keterangan')->nullable();
            $table->string('galeri_top1')->nullable();
            $table->string('galeri_top2')->nullable();
            $table->string('galeri_top3')->nullable();
            $table->string('galeri_middle')->nullable();
            $table->string('galeri_bottom1')->nullable();
            $table->string('galeri_bottom2')->nullable();
            $table->string('galeri_bottom3')->nullable();
            $table->string('galeri_bottom4')->nullable();
            $table->string('galeri_bottom5')->nullable();
            $table->string('galeri_bottom6')->nullable();
            $table->string('video')->nullable();
            $table->string('music')->nullable();
            $table->text('jadwal_nikah_pembuka')->nullable();
            $table->text('jadwal_nikah_isi')->nullable();
            $table->text('jadwal_nikah_tanggal')->nullable();
            $table->text('jadwal_nikah_waktu')->nullable();
            $table->text('jadwal_nikah_lokasi')->nullable();
            $table->string('jadwal_nikah_lokasi_link')->nullable();
           
            $table->text('jadwal_isi_bottom')->nullable();
            $table->text('jadwal_penutup')->nullable();
            
            $table->timestamps();

            $table->foreign('tema_id')->references('id')->on('themes');
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
