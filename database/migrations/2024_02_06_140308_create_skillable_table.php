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
        Schema::create('skillable', function (Blueprint $table) {
            $table->foreignId('skill_id')->constrained("skills")->cascadeOnDelete()->cascadeOnUpdate();
            $table->morphs("skillable");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skillable');
    }
};
