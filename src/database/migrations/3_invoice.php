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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('domain_id')->constrained('domains')->cascadeOnDelete();
            $table->string('perpanjangan_tahun')->nullable();
            $table->date('tanggal_invoice')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('file_invoice')->nullable();
            $table->dateTime('bukti_confirmed')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

    }
    public function down()
    {
        Schema::dropIfExists('ships');

    }
};
