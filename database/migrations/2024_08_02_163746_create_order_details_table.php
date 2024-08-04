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
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('order_id')->index('order_id');
            $table->bigInteger('product_id')->index('product_id');
            $table->integer('quantity');
            $table->integer('discount')->nullable();
            $table->integer('fees')->nullable();
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
