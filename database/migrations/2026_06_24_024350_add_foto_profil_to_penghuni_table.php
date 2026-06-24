<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penghuni', function (Blueprint $table) {
            // Kita tambahkan kolom foto_profil setelah kolom password (boleh null/kosong)
            $table->string('foto_profil')->nullable()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('penghuni', function (Blueprint $table) {
            $table->dropColumn('foto_profil');
        });
    }
};