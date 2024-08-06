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
        //
        Schema::create('feeds', function (Blueprint $table) {
           $table->id();
           $table->foreignId('user_id')->constrained('users');
           $table->string('type');
           $table->string('title');
           $table->text('slug');
           $table->text('content');
           $table->text('media_url');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('feeds');
    }
};
