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
        Schema::create('orders_camping_connection', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('camping_orders')->onDelete('cascade');
            $table->foreignId('camping_id')->constrained('camping')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('totalprice', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_camping_connection');
    }
};
