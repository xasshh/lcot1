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
        Schema::table('users', function (Blueprint $table) {
            $table->string('course_title_code')->nullable();
            $table->string('instructor_name')->nullable();
            $table->text('course_timetable')->nullable();
            $table->text('exam_timetable')->nullable();
            $table->decimal('tuition_balance', 10, 2)->nullable();
            $table->text('payment_history')->nullable(); // JSON or comma-separated
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
