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
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('email');
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('username');
            $table->bigInteger('role_id')->index('role_id');
            $table->string('address')->nullable();
            $table->string('phone', 100)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('wallet_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
