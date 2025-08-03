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

            $table->string('title');
            // $table->enum('status', ['Active', 'Paused', 'Completed', 'Aborted'])->default('Active')->index(); //taking you out
            $table->integer('study_duration')->default(0);  // Minutes completed for multiple sessions
            $table->dateTime('start_time')->nullable();    //backend time tracking
            $table->dateTime('end_time')->nullable();
            $table->text('notes')->nullable()->default('No notes');

            $table->timestamps();
            $table->softDeletes(); // optional: allows recovery of deleted sessions
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
