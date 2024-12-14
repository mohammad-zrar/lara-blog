<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->integer('reading_time')->nullable(); // Estimated reading time in minutes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('posts');
    }
};