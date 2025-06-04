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
        Schema::create('study_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('course_name');
            $table->string('topic');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable()->default(null); // Nullable end time, can be set later
            $table->integer('duration')->nullable(); // Duration in minutes, can be calculated later
            $table->text('notes')->nullable()->default('No notes'); 
            $table->integer('total_study_time')->nullable()->default(0); // Total study time in minutes, can be updated later
            $table->integer('my_study_goal')->default();
            $table->enum('status',['Not Started','Ongoing','Paused','Canceled','Completed'])->default('Not Started'); // Status can be 'ongoing', 'completed', or 'cancelled' 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_sessions');
    }
};
