<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('m_users', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('level_id');

            //authentication
            $table->string('username', 50)->unique();
            $table->string('password');

            //general data
            $table->string('no_induk', 20)->nullable()->comment('NIM/NIDN/NIP');
            $table->string('nama', 50);

            // Specific role
            $table->string('unit')->nullable()->comment('Fakultas/Unit Kerja');
            $table->string('expertise')->nullable()->comment('Bidang keahlian (khusus teknisi)');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('level_id')->references('level_id')->on('m_level')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_users');
    }
};
