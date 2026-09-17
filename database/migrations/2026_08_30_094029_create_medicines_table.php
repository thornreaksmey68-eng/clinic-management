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
        Schema::create('medicines', function (Blueprint $table) {

            $table->id();

            $table->string('medicine_code')->unique();

            $table->string('name');

            $table->string('category')->nullable();

            $table->string('unit')->default('Tablet');

            $table->integer('quantity')->default(0);

            $table->decimal('price', 10, 2)->default(0);

            $table->date('expiry_date')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
