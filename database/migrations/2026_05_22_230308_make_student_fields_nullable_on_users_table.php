<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('matric_number')->nullable()->change();
            $table->string('program_center')->nullable()->change();
            $table->string('program_taken')->nullable()->change();
            $table->string('year_admitted')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('matric_number')->nullable(false)->change();
            $table->string('program_center')->nullable(false)->change();
            $table->string('program_taken')->nullable(false)->change();
            $table->string('year_admitted')->nullable(false)->change();
        });
    }
};
