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
            $table->text('trailer_url')->nullable();
            $table->string('type');
            $table->string('season')->nullable();
            $table->string('vote_average');
            $table->string('vote_count');
            $table->string('time')->nullable();
            $table->string('quality')->nullable();
            $table->string('esp_total');
            $table->string('esp_current');
            $table->text('slug');
            $table->text('description');
            $table->text('produce_by')->nullable();
            $table->dateTime('year');
            $table->integer('view');
            $table->text('thumbnail');
            $table->text('poster');
            $table->text('status');
            $table->timestamp('created_at')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
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
