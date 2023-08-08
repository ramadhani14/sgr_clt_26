<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTablePengaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_table_pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('nama_file')->nullable();
            $table->string('file_status')->nullable();
            $table->string('tanggal_laporan')->nullable();
            $table->string('nama_pelapor')->nullable();
            $table->string('pelaku_utama')->nullable();
            $table->string('judul_laporan')->nullable();
            $table->mediumText('detail_laporan')->nullable();
            $table->mediumText('uraian')->nullable();
            $table->string('status')->nullable();
            $table->string('no_reg')->nullable();
            $table->integer('created_by');
            $table->datetime('created_at');
            $table->integer('updated_by')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_table_pengaduan');
    }
}
