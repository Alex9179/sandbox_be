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
        Schema::create('test_areas', function (Blueprint $table) {
            $table->id();
            $table->string('area_code')->nullable();
            $table->string('area_name')->nullable();
            $table->geometry('geom')->isGeometry()->nullable();
        });

        // add geospatial index
        DB::statement("CREATE INDEX area_index
          ON test_areas
          USING GIST (geom)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_areas');
    }
};
