<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quiz_id')
                  ->constrained('quizzes')
                  ->onDelete('cascade');

            $table->text('question_text');
            $table->enum('type', ['mcq', 'open'])->default('mcq');
            $table->integer('marks')->default(10);

            $table->unsignedInteger('order')->default(999);  // for sorting questions

            $table->timestamps();

            // Unique order per quiz
            $table->unique(['quiz_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};