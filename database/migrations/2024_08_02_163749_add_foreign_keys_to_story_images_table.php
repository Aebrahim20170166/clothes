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
        Schema::table('story_images', function (Blueprint $table) {
            $table->foreign(['story_id'], 'story_images_ibfk_1')->references(['id'])->on('stories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('story_images', function (Blueprint $table) {
            $table->dropForeign('story_images_ibfk_1');
        });
    }
};
