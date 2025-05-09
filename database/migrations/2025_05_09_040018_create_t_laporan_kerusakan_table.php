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
            $table->unsignedBigInteger('sarana_id');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('gedung_id');
            $table->unsignedBigInteger('lantai_id'); // Ditambahkan kolom yang missing

            // Detail laporan
            $table->string('laporan_judul', 100);
            $table->text('laporan_deskripsi');
            $table->string('laporan_foto')->nullable();
            $table->enum('urgensi', ['rendah', 'sedang', 'tinggi', 'kritis'])->default('sedang');

            // Status penanganan
            $table->enum('status', ['dilaporkan', 'diverifikasi', 'diproses', 'selesai', 'ditolak'])->default('dilaporkan');
            $table->unsignedBigInteger('teknisi_id')->nullable();
            $table->text('catatan_teknisi')->nullable();
            
            // Timestamps
            $table->timestamp('waktu_lapor')->useCurrent();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps(); // Hanya dipanggil sekali di sini

            // Foreign keys
            $table->foreign('user_id')->references('user_id')->on('m_users'); // Diubah ke m_users
            $table->foreign('sarana_id')->references('sarana_id')->on('m_sarana'); // Diubah ke m_sarana
            $table->foreign('gedung_id')->references('gedung_id')->on('m_gedung'); // Diubah ke m_gedung
            $table->foreign('lantai_id')->references('lantai_id')->on('m_lantai'); // Diubah ke m_lantai
            $table->foreign('teknisi_id')->references('user_id')->on('m_users'); // Diubah ke m_users
            $table->foreign('ruang_id')->references('ruang_id')->on('m_ruang'); // Diubah ke m_ruang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_laporan_kerusakan', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['user_id']);
            $table->dropForeign(['sarana_id']);
            $table->dropForeign(['gedung_id']);
            $table->dropForeign(['lantai_id']);
            $table->dropForeign(['teknisi_id']);
            $table->dropForeign(['ruang_id']);
        });
        
        Schema::dropIfExists('m_laporan_kerusakan');
    }
};