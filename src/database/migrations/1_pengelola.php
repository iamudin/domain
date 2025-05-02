<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengelolas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('jenis_pengelola',['Desa','Badan / Dinas / Kecamatan / Kelurahan'])->nullable();
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nohp')->nullable();
            $table->string('surat_keterangan')->nullable();
            $table->string('surat_kuasa')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

    }
    public function down()
    {
        Schema::dropIfExists('ships');

    }
};
