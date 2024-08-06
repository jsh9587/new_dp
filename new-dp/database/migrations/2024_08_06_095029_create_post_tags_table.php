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
        Schema::create('feed_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feed_id')->references('id')->on('feeds')->onDelete('cascade');
            $table->foreignId('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('feed_tags');

    }
};
