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
        Schema::create('admissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('patient_id');
            $table->date('admission_date');
            $table->date('discharge_date')->nullable();
            $table->string('diagnosis', 50);
            $table->unsignedBigInteger('attending_doctor_id');

            $table->primary(['patient_id', 'admission_date']);
            $table->index('attending_doctor_id');

            $table->foreign('patient_id')
                ->references('patient_id')
                ->on('patients');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
        });

        Schema::dropIfExists('admissions');
    }
};
