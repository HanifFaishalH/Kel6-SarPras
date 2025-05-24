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
        Schema::create('t_laporan_kerusakan', function (Blueprint $table) {
            $table->id('laporan_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('gedung_id');
            $table->unsignedBigInteger('lantai_id'); // Ditambahkan kolom yang missing
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('sarana_id');
            
            // Detail laporan
            $table->string('laporan_judul', 100);
            $table->string('laporan_foto')->nullable();
            $table->enum('tingkat_kerusakan', ['rendah', 'sedang', 'tinggi']);
            $table->enum('tingkat_urgensi', ['rendah', 'sedang', 'tinggi', 'kritis']);
            $table->enum('frekuensi_penggunaan', ['harian', 'mingguan', 'bulanan', 'tahunan']);
            $table->date('tanggal_operasional');
            $table->timestamps();

            //status
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->unsignedBigInteger('teknisi_id')->nullable();
            $table->text('catatan_teknisi')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->date('tanggal_selesai_diperbaiki')->nullable();
            $table->date('tanggal_diterima_teknisi')->nullable();

            // Foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('m_users')->onDelete('cascade');
            $table->foreign('sarana_id')->references('sarana_id')->on('m_sarana')->onDelete('cascade');
            $table->foreign('ruang_id')->references('ruang_id')->on('m_ruang')->onDelete('cascade');
            $table->foreign('lantai_id')->references('lantai_id')->on('m_lantai')->onDelete('cascade');
            $table->foreign('gedung_id')->references('gedung_id')->on('m_gedung')->onDelete('cascade');
            $table->foreign('teknisi_id')->references('teknisi_id')->on('m_teknisi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_laporan_kerusakan', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['user_id']);
            $table->dropForeign(['sarana_id']);
            $table->dropForeign(['gedung_id']);
            $table->dropForeign(['lantai_id']);
            $table->dropForeign(['teknisi_id']);
            $table->dropForeign(['ruang_id']);
        });
        
        Schema::dropIfExists('t_laporan_kerusakan');
    }
};