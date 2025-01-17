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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('name');
            $table->dateTime('birthday')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('phone')->unique()->nullable();
            $table->string('password');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('profile');
    }
};
