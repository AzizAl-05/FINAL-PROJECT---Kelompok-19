<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            // Menambahkan kolom icon yang boleh kosong (nullable)
            // Defaultnya kita beri 'check' jika admin tidak memilih ikon
            $table->string('icon')->nullable()->default('check')->after('nama_fasilitas');
        });
    }

    public function down(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
