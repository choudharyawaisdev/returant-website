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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to orders table
            $table->unsignedBigInteger('order_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->string('title');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2); // Price per unit (including size/add-on pricing)
            $table->decimal('total_price', 10, 2); // unit_price * quantity
            $table->string('size_name')->nullable();
            $table->json('add_ons_details')->nullable(); // Store details like [{"name": "Extra Cheese", "price": 50}]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};