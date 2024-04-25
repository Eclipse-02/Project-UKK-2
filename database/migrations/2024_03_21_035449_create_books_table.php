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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('category_id');
            $table->string('file_name', 128)->nullable();
            $table->string('cover', 128)->nullable();
            $table->string('title', 128);
            $table->string('writer', 128);
            $table->string('desc', 256);
            $table->string('isbn', 13)->nullable();
            $table->smallInteger('year');
            $table->smallInteger('book_count');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
