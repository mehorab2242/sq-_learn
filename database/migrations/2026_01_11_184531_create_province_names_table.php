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
        Schema::create('province_names', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('province_id', 2)->primary();
            $table->string('province_name', 30);
        });

        Schema::table('patients', function (Blueprint $table) {
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
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
        });

        Schema::dropIfExists('province_names');
    }
};
