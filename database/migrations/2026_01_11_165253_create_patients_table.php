<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('patient_id');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->char('gender', 1);
            $table->date('birth_date');
            $table->string('city', 30);
            $table->char('province_id', 2);
            $table->string('allergies', 80);
            $table->decimal('height', 3, 0);
            $table->decimal('weight', 4, 0);

            $table->index('province_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
