<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('program')->nullable()->after('code');   // bachelor | special_executive | masters
            $table->string('level')->nullable()->after('program');   // 100–500 (600 = masters)
            $table->string('semester')->nullable()->after('level');  // First/Second Semester, Module 1–4, masters group
            $table->index(['program', 'level']);
        });

        // Masters courses carry 1½-unit credits; doctrine/dbal is not installed so change() is unavailable
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE courses MODIFY unit DECIMAL(4,1) NULL');
        }
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropIndex(['program', 'level']);
            $table->dropColumn(['program', 'level', 'semester']);
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE courses MODIFY unit INT NULL');
        }
    }
};
