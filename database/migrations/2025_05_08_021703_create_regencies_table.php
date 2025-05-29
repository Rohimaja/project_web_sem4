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
        Schema::create('kotas', function (Blueprint $table) {
            $table->char('id', 4); // atau bisa pakai varchar juga
            $table->char('provinsi_id', 2); // ← pastikan ini ADA sebelum foreign()
            $table->string('name');
            $table->primary('id'); // menjadikan kolom ini primary key
            $table->foreign('provinsi_id')->references('id')->on('provinsis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kotas');
    }
};
