<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL ENUM requires a raw ALTER to extend values
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student','staff','admin','super_admin') NOT NULL DEFAULT 'student'");
    }

    public function down(): void
    {
        // Update any super_admin rows back to admin before shrinking the enum
        DB::statement("UPDATE users SET role = 'admin' WHERE role = 'super_admin'");
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('student','staff','admin') NOT NULL DEFAULT 'student'");
    }
};
