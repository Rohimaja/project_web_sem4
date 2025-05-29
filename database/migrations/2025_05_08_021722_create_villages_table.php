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
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->char('id', 10); // atau bisa pakai varchar juga
            $table->char('kecamatan_id', 7); // ← pastikan ini ADA sebelum foreign()
            $table->string('name');
            $table->primary('id'); // menjadikan kolom ini primary key
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahans');
    }
};
