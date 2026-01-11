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
        Schema::create('patients', function (Blueprint $table) {
            $table->integer('patient_id')->primary(); // Primary key
            $table->text('first_name');
            $table->text('last_name');
            $table->char('gender', 1);
            $table->date('birth_date');
            $table->text('city');
            $table->char('province_id', 2);
            $table->text('allergies')->nullable();
            $table->text('height')->nullable();
            $table->integer('weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
