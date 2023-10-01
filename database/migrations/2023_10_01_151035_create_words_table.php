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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('word', 255);
            $table->foreignId('word_type_id')->nullable();
            $table->boolean('appropriate')->default(false);
            // $table->foreignId('user_id'); // Might not need this
            $table->timestamps();

            $table->unique(['word', 'word_type_id'], 'word_word_type_idnex');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
