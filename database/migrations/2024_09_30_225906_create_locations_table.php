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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('city', 80);
            $table->string('country', 4);
            $table->decimal('lat', 10, 7); 
            $table->decimal('lng', 10, 7);
            $table->string('weather', 50);
            $table->string('weather_description', 150);
            $table->string('weather_icon', 255);
            $table->decimal('temp_min', 10, 2);
            $table->decimal('temp_max', 10, 2);
            $table->foreignId('user_id')
                ->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
