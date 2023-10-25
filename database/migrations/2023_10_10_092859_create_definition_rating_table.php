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
        Schema::create('definition_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('definition_id')->constrained()->onDelete('cascade');
            $table->foreignId('rating_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->default(0);
            $table->tinyInteger('value')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('definition_rating');
    }
};
