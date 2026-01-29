<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_resources', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lesson_id')
                  ->constrained('lessons')
                  ->onDelete('cascade');

            $table->string('title', 255)->nullable();           // "Installation Guide PDF", "Setup Video"

            $table->enum('type', [
                'pdf',
                'video',
                'image',
                'audio',
                'link',         // external URL
                'embed',        // iframe code
                'file',         // any other uploaded file (zip, docx, etc.)
            ]);

            $table->string('path')->nullable();                 // storage path: lessons/101/resources/guide.pdf

            $table->string('url')->nullable();                  // external: https://youtube.com/...

            $table->text('description')->nullable();

            $table->unsignedInteger('display_order')->default(999);

            $table->boolean('is_downloadable')->default(true);

            $table->timestamps();

            // Optional: unique order per lesson
            $table->unique(['lesson_id', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_resources');
    }
};