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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('email')->nullable()->nullable();
            $table->text('delivery_address')->nullable();
            $table->text('special_instructions')->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('delivery_fee', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->enum('payment_method', ['COD', 'Online'])->default('COD');
            $table->enum('status', ['Pending', 'Processing', 'Delivered', 'Cancelled'])->default('Pending');
            
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