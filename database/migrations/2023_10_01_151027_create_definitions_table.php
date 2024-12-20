<?php

use App\Models\Word;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        Schema::create('definitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_id')->default(0)->constrained()->onDelete('cascade');
            $table->text('definition');
            $table->foreignId('user_id')->default(1);
            $table->foreignId('word_type_id')->default(1);
            $table->boolean('appropriate')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('definitions');
    }


};
