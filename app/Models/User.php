<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'level',
        'program',
        'gpa',
        'cgpa',
        'course_title_code',
        'instructor_name',
        'course_timetable',
        'exam_timetable',
        'tuition_balance',
        'payment_history',
        'matric_number',
        'program_center',
        'program_taken',
        'year_admitted',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('level');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    /**
     * Canonical program key (bachelor | special_executive | masters), or null
     * for legacy accounts that pre-date program tracks.
     */
    public function programKey(): ?string
    {
        return array_key_exists($this->program, Course::PROGRAMS) ? $this->program : null;
    }

    public function programLabel(): ?string
    {
        $key = $this->programKey();

        return $key ? Course::PROGRAMS[$key] : $this->program_taken;
    }

    /**
     * The level the student is currently at, defaulting to the first level
     * of their program.
     */
    public function currentLevel(): ?string
    {
        if ($this->level) {
            return (string) $this->level;
        }

        $key = $this->programKey();

        return $key ? Course::PROGRAM_LEVELS[$key][0] : null;
    }

    public function hasRegisteredCoursesForLevel(?string $level): bool
    {
        if (! $level) {
            return false;
        }

        return $this->courses()->wherePivot('level', $level)->exists();
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }

    public function isStaff(): bool
    {
        return in_array($this->role, ['staff', 'admin', 'super_admin']);
    }
}
