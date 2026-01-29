<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quiz_attempt_id')->constrained()->onDelete('cascade');
            $table->foreignId('quiz_question_id')->constrained()->onDelete('cascade');

            // What the student actually submitted
            $table->text('submitted_value')->nullable();          // for open: text answer
            // for MCQ: comma-separated option IDs "9001,9003"
            // or JSON: "[9001,9003]" or "{\"selected\":[9001]}"

            $table->string('file_path')->nullable();              // for open: uploaded document/screenshot/video path

            $table->integer('marks_awarded')->nullable();         // filled after auto-grade or manual grade

            $table->timestamps();

            $table->unique(['quiz_attempt_id', 'quiz_question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
    }
};
