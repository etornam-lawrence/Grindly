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
        Schema::create('xp_levels', function (Blueprint $table) {
            $table->id();
            $table->integer('level')->default(1);
            $table->string('level_name')->unique();
            $table->integer('xp_needed')->default(100); // XP needed to reach this level
            $table->integer('xp_reward')->default(10); // XP rewarded for completing this level
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xp_levels');
    }
};
