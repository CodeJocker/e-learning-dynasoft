<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');                // student

            $table->foreignId('lesson_id')
                  ->constrained('lessons')
                  ->onDelete('cascade');

            $table->timestamp('completed_at')->nullable();  // null = not completed yet

            $table->timestamp('started_at')->nullable();    // when student first opened it

            $table->integer('time_spent_seconds')->default(0);  // optional: track real time spent

            $table->boolean('is_completed')->default(false);

            $table->timestamps();

            // One progress record per student per lesson
            $table->unique(['user_id', 'lesson_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_progress');
    }
};