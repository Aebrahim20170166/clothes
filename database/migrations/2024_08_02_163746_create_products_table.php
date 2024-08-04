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
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name', 100);
            $table->text('description');
            $table->integer('price_before');
            $table->integer('num_stars')->nullable();
            $table->integer('price_after')->nullable();
            $table->bigInteger('color')->index('color');
            $table->bigInteger('size')->index('size');
            $table->bigInteger('category_id')->index('category');
            $table->bigInteger('admin_id')->index('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
