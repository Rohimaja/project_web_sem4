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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matkul_id')->constrained('matkuls');
            $table->unsignedTinyInteger('pertemuan_ke'); // 1 - 16
            $table->date('tanggal')->nullable(); // boleh kosong kalau belum tahu
            $table->enum('status', ['aktif', 'libur', 'uts', 'uas'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuans');
    }
};
