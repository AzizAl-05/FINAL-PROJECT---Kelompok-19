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
        Schema::table('penghuni', function (Blueprint $table) {
            $table->Timestamps();
        });

        Schema::table('kamar', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('tipe');
        });

        Schema::table('transaksi_sewa', function (Blueprint $table) {

            $table->date('tanggal_mulai')
                  ->nullable()
                  ->after('periode_sewa');

            $table->tinyInteger('status')
                  ->default(0)
                  ->after('jumlah_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penghuni', function (Blueprint $table) {
             $table->dropTimestamps();
        });

        Schema::table('kamar', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('transaksi_sewa', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'tanggal_mulai',
            ]);
        });
    }
};
