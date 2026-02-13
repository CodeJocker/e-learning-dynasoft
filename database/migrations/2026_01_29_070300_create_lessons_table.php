<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                  ->constrained()
                  ->onDelete('cascade'); // delete lessons if course deleted

            $table->string('title', 255);
            $table->unsignedInteger('order')->default(999); // for sorting lessons

            $table->enum('type', [
                'text',      // rich text / markdown
                'video',     // embedded or uploaded
                'audio',
                'document',  // pdf, etc.
                'external',  // link to YouTube/other site
                'quiz',      // simple inline quiz (optional)
            ])->default('text');

            $table->longText('content')->nullable(); // main lesson body (HTML/markdown)

            $table->string('video_url')->nullable(); // external embed URL
            $table->string('document_path')->nullable(); // storage path for PDF/file

            $table->integer('duration_minutes')->nullable(); // estimated time to complete


            $table->timestamps();
            $table->softDeletes();

            // Ensure no duplicate order per course
            $table->unique(['course_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};