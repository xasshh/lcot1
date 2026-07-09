<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The Master's programme has no numeric levels (the course document lists
     * core courses + specialisation groups only). It was initially seeded as
     * level '600' — rename that to 'Masters' everywhere it was stored.
     */
    public function up(): void
    {
        DB::table('courses')->where('level', '600')->update(['level' => 'Masters']);
        DB::table('users')->where('level', '600')->update(['level' => 'Masters']);
        DB::table('course_user')->where('level', '600')->update(['level' => 'Masters']);
        DB::table('results')->where('level', '600')->update(['level' => 'Masters']);
    }

    public function down(): void
    {
        DB::table('courses')->where('level', 'Masters')->update(['level' => '600']);
        DB::table('users')->where('level', 'Masters')->update(['level' => '600']);
        DB::table('course_user')->where('level', 'Masters')->update(['level' => '600']);
        DB::table('results')->where('level', 'Masters')->update(['level' => '600']);
    }
};
