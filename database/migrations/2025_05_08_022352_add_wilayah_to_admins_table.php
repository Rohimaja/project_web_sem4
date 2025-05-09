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
        Schema::table('admins', function (Blueprint $table) {
            $table->char('province_id', 2); // ← pastikan ini ADA sebelum foreign()
            $table->char('regency_id', 4); // ← pastikan ini ADA sebelum foreign()
            $table->char('district_id', 7); // ← pastikan ini ADA sebelum foreign()
            $table->char('village_id', 10); // ← pastikan ini ADA sebelum foreign()


            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('village_id')->references('id')->on('villages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
};
