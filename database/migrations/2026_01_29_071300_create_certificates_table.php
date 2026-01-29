<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');                    // student who earned it

            $table->foreignId('course_id')
                ->constrained('courses')
                ->onDelete('cascade');

            $table->foreignId('course_progress_id')           // link to the progress record at issuance time
                ->nullable()
                ->constrained('course_progress')
                ->onDelete('set null');

            $table->string('certificate_code', 50)->unique(); // e.g. CERT-LAR-2025-0042
            $table->timestamp('issued_at')->useCurrent();

            $table->string('pdf_path')->nullable();           // path to generated PDF certificate
            $table->string('verification_url')->nullable();   // public link to verify certificate

            $table->text('notes')->nullable();                // admin notes if needed

            $table->timestamps();

            // Prevent duplicate certificates per student per course
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
