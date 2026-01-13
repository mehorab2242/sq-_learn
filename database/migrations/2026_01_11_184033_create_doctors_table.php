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
        Schema::create('doctors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('doctor_id');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('speciality', 25);
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->foreign('attending_doctor_id')
                ->references('doctor_id')
                ->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['attending_doctor_id']);
        });

        Schema::dropIfExists('doctors');
    }
};
