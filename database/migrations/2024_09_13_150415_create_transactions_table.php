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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_code', 12)->primary()->unique();
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('price', 10, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
