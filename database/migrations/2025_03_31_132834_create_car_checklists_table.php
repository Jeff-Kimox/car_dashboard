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
        Schema::create('car_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->unsignedInteger('mileage');
            $table->timestamp('checked_at');
            $table->boolean('tires_checked')->default(false);
            $table->boolean('oil_level_checked')->default(false);
            $table->boolean('lights_checked')->default(false);
            $table->boolean('brakes_checked')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_checklists');
    }
};
