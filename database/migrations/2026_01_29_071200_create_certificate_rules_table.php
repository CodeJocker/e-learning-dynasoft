<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificate_rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->onDelete('cascade');

            // Minimum requirements
            $table->decimal('min_percent_required', 5, 2)->default(100.00);     // e.g. 90.00
            $table->boolean('require_all_lessons')->default(true);
            $table->boolean('require_all_quizzes')->default(true);
            $table->integer('min_quiz_average')->default(70);                   // % average across quizzes

            // Optional extras
            $table->integer('min_attendance_percent')->nullable();              // if you later add attendance
            $table->boolean('requires_portfolio')->default(false);

            $table->text('description')->nullable();                            // admin note

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificate_rules');
    }
};
