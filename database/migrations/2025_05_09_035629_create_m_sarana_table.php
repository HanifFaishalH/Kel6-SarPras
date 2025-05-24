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
            $table->string('sarana_kode')->unique();
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('barang_id');
            $table->date('tanggal_operasional')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori')->onDelete('cascade');
            $table->foreign('barang_id')->references('barang_id')->on('m_barang')->onDelete('cascade');
            $table->foreign('ruang_id')->references('ruang_id')->on('m_ruang')->onDelete('cascade');
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
