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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->float('IMDb');
            $table->text('title_original')->nullable();
            $table->string('type')->nullable();
            $table->dateTime('time')->nullable();
            $table->integer('esp_total')->nullable();
            $table->integer('esp_current')->nullable();
            $table->text('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('produce_by');
            $table->dateTime('release_year')->nullable();
            $table->text('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
