<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'code', 'instructor', 'unit'];

    public function students()
    {
        return $this->belongsToMany(User::class);
    }
}
