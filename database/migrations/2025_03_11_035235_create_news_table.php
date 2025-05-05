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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('editor_id');
            $table->unsignedBigInteger('category_id');

            $table->string('title');
            $table->text('image');
            $table->string('slug');
            $table->text('content');
            $table->enum('status', ['draft', 'published']);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('author');
            $table->foreign('editor_id')->references('id')->on('editor');
            $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
