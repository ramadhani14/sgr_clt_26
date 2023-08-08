<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTableP2hp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_table_p2hp', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('nama_file')->nullable();
            $table->string('file_status')->nullable();
            $table->string('nama')->nullable();
            $table->string('tahun')->nullable();
            $table->decimal('pagu_anggaran',17,2)->nullable();
            $table->mediumText('kondisi_temuan')->nullable();
            $table->mediumText('kelompok_temuan')->nullable();
            $table->decimal('nilai_temuan',17,2)->nullable();
            $table->mediumText('rekomendasi')->nullable();
            $table->string('nama_pj')->nullable();
            $table->string('jabatan_pj_terperiksa')->nullable();
            $table->string('jenis_audit')->nullable();
            $table->string('no_pkp')->nullable();
            $table->string('ketua_tim')->nullable();
            $table->string('tgl_p2hp')->nullable();
            $table->string('no_surat')->nullable();
            $table->mediumText('ket')->nullable();
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
        Schema::dropIfExists('master_table_p2hp');
    }
}
