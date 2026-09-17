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
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            // Patient who makes the payment
            $table->foreignId('patient_id')
                ->constrained('patients')
                ->cascadeOnDelete();

            // Appointment related to the payment
            $table->foreignId('appointment_id')
                ->nullable()
                ->constrained('appointments')
                ->nullOnDelete();

            $table->string('payment_code')->unique();

            $table->decimal('amount', 10, 2);

            $table->string('payment_method')
                ->default('Cash');

            $table->string('status')
                ->default('Paid');

            $table->date('payment_date');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
