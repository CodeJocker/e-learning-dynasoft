<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade');  // quiz belongs to course

            // $table->foreignId('lesson_id')
            //       ->nullable()
            //       ->constrained('lessons')
            //       ->onDelete('cascade');  // optional: quiz tied to specific lesson

            $table->string('title', 255);
            $table->text('description')->nullable();

            $table->integer('time_limit_minutes')->default(30);
            $table->integer('max_attempts')->default(1);
            $table->integer('passing_score')->default(70);  // % to pass

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};