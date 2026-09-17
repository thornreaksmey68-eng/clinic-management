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
        Schema::create('prescription_items', function (Blueprint $table) {

            $table->id();

            // Prescription
            $table->foreignId('prescription_id')
                ->constrained('prescriptions')
                ->cascadeOnDelete();

            // Medicine
            $table->foreignId('medicine_id')
                ->constrained('medicines')
                ->cascadeOnDelete();

            // Medicine quantity
            $table->integer('quantity');

            // How to take the medicine
            $table->string('dosage')->nullable();

            // Example: After meal, Before meal, etc.
            $table->string('instruction')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
