<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Core identification & ownership
            $table->string('title', 255);
            $table->string('slug')->unique();           // for clean URLs: laravel-for-beginners
            $table->foreignId('instructor_id')
                  ->constrained('users')
                  ->onDelete('cascade');               // if instructor deleted → course deleted

            // Content & metadata
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();    // path: courses/10/thumbnail.jpg

            // Categorization
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('course_categories')
                  ->onDelete('set null');

            // Status & visibility
            $table->enum('status', ['draft', 'published', 'archived'])
                  ->default('draft');
            $table->timestamp('published_at')->nullable();


            // Statistics / SEO
            $table->integer('enrollments_count')->default(0);
            $table->integer('lessons_count')->default(0);
            $table->integer('quizzes_count')->default(0);

            // Timestamps
            $table->timestamps();
            $table->softDeletes();                      // important for LMS – courses can be "deleted" but recoverable
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};