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
        Schema::create('t_rekomendasi_laporan', function (Blueprint $table) {
            $table->id('rekomendasi_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('laporan_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('m_users')->onDelete('cascade');
            $table->foreign('laporan_id')->references('laporan_id')->on('t_laporan_kerusakan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_rekomendasi_laporan');
    }
};
