<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('level')->nullable();
            $table->string('program')->nullable();
            $table->decimal('gpa', 4, 2)->nullable();
            $table->decimal('cgpa', 4, 2)->nullable();
            $table->string('profile_photo')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['level', 'program', 'gpa', 'cgpa', 'profile_photo']);
        });
    }
};
