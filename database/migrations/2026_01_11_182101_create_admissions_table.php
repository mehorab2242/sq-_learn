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
            $table->unsignedBigInteger('patient_id');
            $table->date('admission_date');
            $table->date('discharge_date')->nullable();
            $table->string('diagnosis', 50)->nullable();
            $table->unsignedBigInteger('attending_doctor_id');
            $table->timestamps();

            $table->primary(['patient_id', 'admission_date']);

            $table->foreign('patient_id')
                ->references('patient_id')
                ->on('patients');

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
        Schema::dropIfExists('admissions');
    }
};
