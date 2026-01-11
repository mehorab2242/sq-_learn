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
            $table->id('patient_id');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->char('gender', 1)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('city', 30)->nullable();
            $table->char('province_id', 2)->nullable();
            $table->string('allergies', 80)->nullable();
            $table->decimal('height', 3, 0)->nullable();
            $table->decimal('weight', 4, 0)->nullable();
            $table->timestamps();

            $table->foreign('province_id')
                ->references('province_id')
                ->on('province_names');
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
