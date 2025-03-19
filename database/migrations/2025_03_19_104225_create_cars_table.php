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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('vin_number')->unique()->nullable(); // Vehicle Identification Number
            $table->string('make'); // e.g., Toyota, Ford, Honda
            $table->string('model'); // e.g., Camry, F-150, Civic
            $table->integer('year')->nullable(); // Manufacturing year
            $table->string('color')->nullable();
            $table->integer('mileage')->nullable(); // Mileage in kilometers or miles
            $table->string('engine_type')->nullable(); // e.g., Petrol, Diesel, Electric
            $table->string('transmission')->nullable(); // e.g., Automatic, Manual
            $table->string('body_type')->nullable(); // e.g., Sedan, SUV, Truck
            $table->string('plate_number')->unique();
            $table->foreignId('car_owner_id')->constrained('car_owners')->onDelete('cascade');
            $table->text('notes')->nullable(); // Any additional notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
