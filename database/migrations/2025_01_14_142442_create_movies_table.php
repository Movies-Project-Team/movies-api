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
            $table->float('IMDb')->nullable();
            $table->text('title_original');
            $table->text('trailer_url');
            $table->string('type');
            $table->dateTime('time');
            $table->integer('esp_total');
            $table->integer('esp_current');
            $table->text('slug');
            $table->text('description');
            $table->text('produce_by')->nullable();
            $table->dateTime('release_year');
            $table->text('thumbnail');
            $table->timestamp('created_at');
            $table->unsignedInteger('created_by');
            $table->timestamp('updated_at');
            $table->unsignedInteger('updated_by');
            $table->timestamp('deleted_at');
            $table->unsignedInteger('deleted_by');
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
