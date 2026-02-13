<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();

            // Who is enrolled in which course
            $table->foreignId('user_id')                    // student
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade');

            // When and in what state
            $table->timestamp('enrolled_at')->useCurrent();

            $table->enum('status', [
                'active',           // currently learning
                'completed',        // finished the course
                'dropped',          // student left voluntarily
                'suspended',        // admin blocked access
            ])->default('active');

            $table->timestamp('completed_at')->nullable();  // only filled when status = completed

            // Optional but very useful in real systems
            $table->timestamp('last_accessed_at')->nullable();  // when student was last active in this course

            $table->timestamps();

            // Prevent duplicate enrollments
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_enrollments');
    }
};