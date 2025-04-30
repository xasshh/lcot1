<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course_User extends Model
{
    protected $table = 'Course_User';
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

public function course()
{
    return $this->belongsTo(\App\Models\Course::class);
}

}
