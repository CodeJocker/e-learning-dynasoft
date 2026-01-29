<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            
            $table->string('name', 100);                    // "Web Development", "Mobile Apps", "Data Science"
            $table->string('icon')->nullable();             // heroicons name, font-awesome class or svg path
            $table->text('description')->nullable();        // short description shown on category page
            $table->integer('display_order')->default(999); // for manual sorting on frontend
            $table->boolean('is_active')->default(true);    // hide/show category without deleting

            $table->timestamps();
            $table->softDeletes();                          // allow soft delete (common in admin panels)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_categories');
    }
};