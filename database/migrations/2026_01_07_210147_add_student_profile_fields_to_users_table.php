<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('program_center')->after('email');
            $table->string('program_taken')->after('program_center');
            $table->string('year_admitted')->after('program_taken');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'program_center',
                'program_taken',
                'year_admitted',
            ]);
        });
    }
};
