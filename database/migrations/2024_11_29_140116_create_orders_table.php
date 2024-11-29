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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('cash_on_delivery');

            /**
             * Shipping Information Cash on delivery
             */
            $table->string('name');
            $table->string('email');
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
