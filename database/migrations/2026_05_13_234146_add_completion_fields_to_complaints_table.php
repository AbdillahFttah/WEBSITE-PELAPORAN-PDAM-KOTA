<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dateTime('tanggal_selesai')->nullable()->after('status');
            $table->enum('bagian', ['teknisi', 'administrasi'])->nullable()->after('tanggal_selesai');
            $table->text('penyelesaian')->nullable()->after('bagian');
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_selesai',
                'bagian',
                'penyelesaian',
            ]);
        });
    }
};