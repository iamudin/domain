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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('pengelola_id')->constrained('pengelolas')->cascadeOnDelete();
            $table->string('nama')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->string('ns1')->nullable();
            $table->string('ns2')->nullable();
            $table->string('ns3')->nullable();
            $table->string('ns4')->nullable();
            $table->string('ipv4')->nullable();
            $table->dateTime('ns_updated')->nullable();
            $table->dateTime('ns_confirmed')->nullable();
            $table->dateTime('ipv4_updated')->nullable();
            $table->dateTime('ipv4_confirmed')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

    }
    public function down()
    {
        Schema::dropIfExists('ships');

    }
};
