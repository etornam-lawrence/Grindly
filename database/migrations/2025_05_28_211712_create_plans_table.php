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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Title of the plan
            $table->text('goal'); // The goal of the plan
            $table->text('how_to'); // How to achieve the goal
            $table->string('bg_image')->nullable(); // Background image URL
            $table->dateTime('start_date')->nullable(); // Start date of the plan
            $table->dateTime('end_date')->nullable(); // End date of the plan
            // $table->boolean('is_completed')->default(false); // Completion status of the plan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
