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
            $table->text('title');
            $table->float('IMDb');
            $table->text('title_original');
            $table->string('type');
            $table->dateTime('time');
            $table->integer('esp_total');
            $table->integer('esp_current');
            $table->text('slug');
            $table->text('description');
            $table->text('produce_by');
            $table->dateTime('release_year');
            $table->text('thumbnail');
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
