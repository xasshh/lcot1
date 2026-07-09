<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            // Level the student was at when they registered the course,
            // so registration can be repeated per level as they progress.
            $table->string('level')->nullable()->after('course_id');
        });
    }

    public function down(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
};
