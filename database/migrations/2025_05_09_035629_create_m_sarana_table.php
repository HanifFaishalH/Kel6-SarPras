<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_sarana', function (Blueprint $table) {
            $table->id('sarana_id');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('gedung_id')->nullable();
            $table->string('sarana_nama', 50)->unique();
            $table->string('sarana_kode', 20)->unique();
            $table->string('sarana_tipe', 20)->comment('Tipe sarana (meja, kursi, proyektor, dll)');
            $table->integer('sarana_jumlah')->default(0)->comment('Jumlah sarana yang tersedia');
            $table->string('sarana_kondisi', 20)->comment('Kondisi sarana (rusak, perlu perbaikan)');
            $table->string('sarana_gambar')->nullable()->comment('Path gambar sarana');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('ruang_id')->references('ruang_id')->on('m_ruang')->onDelete('cascade');
            $table->foreign('gedung_id')->references('gedung_id')->on('m_gedung')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_sarana');
    }
};
