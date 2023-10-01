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
        Schema::create('definition_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')->default(0);
            $table->foreignid('definition_id')->default(0);
            $table->foreignid('rating_id')->default(0);
            $table->unsignedTinyInteger('value')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('definition_ratings');
    }
};
