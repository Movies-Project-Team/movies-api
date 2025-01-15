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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->integer('season');
            $table->text('title')->nullable();
            $table->integer('episode')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->text('slug')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
