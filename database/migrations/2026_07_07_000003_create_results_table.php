<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Mirrors the "RESULT CHECK LIST" document: one row per course score,
     * grouped by student + session (YEAR) + level, split into semesters.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->string('course_title'); // snapshot so results survive course edits/deletes
            $table->string('session');      // YEAR on the checklist, e.g. 2025/2026
            $table->string('level');        // 100–600
            $table->string('semester');     // First Semester / Second Semester / Module 1–4 / masters group
            $table->decimal('score', 5, 2); // SCORES %
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'session', 'level', 'course_title'], 'results_student_session_course_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
