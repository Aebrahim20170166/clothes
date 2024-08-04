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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['category_id'], 'products_ibfk_1')->references(['id'])->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['color'], 'products_ibfk_2')->references(['id'])->on('colors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['size'], 'products_ibfk_3')->references(['id'])->on('sizes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['admin_id'], 'products_ibfk_4')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_ibfk_1');
            $table->dropForeign('products_ibfk_2');
            $table->dropForeign('products_ibfk_3');
            $table->dropForeign('products_ibfk_4');
        });
    }
};
