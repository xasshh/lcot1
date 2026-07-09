<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public const PROGRAMS = [
        'bachelor'          => "Bachelor's Degree Programme",
        'special_executive' => "Special Executive Bachelor's Degree",
        'masters'           => "Master's Degree Programme",
    ];

    /**
     * Bachelor's runs 100–500 level, Special Executive 100–300 level (per the
     * college's course documents). The Master's programme has no levels — it
     * is a single stage, represented here as 'Masters'.
     */
    public const PROGRAM_LEVELS = [
        'bachelor'          => ['100', '200', '300', '400', '500'],
        'special_executive' => ['100', '200', '300'],
        'masters'           => ['Masters'],
    ];

    /**
     * Display order of the semester/module/group headings within a level.
     */
    public const SEMESTER_ORDER = [
        'First Semester',
        'Second Semester',
        'Module 1',
        'Module 2',
        'Module 3',
        'Module 4',
        'Core Courses',
        'Biblical Studies',
        'Leadership',
        'Mission/Church Growth',
        'Christian Education',
    ];

    protected $fillable = ['title', 'code', 'instructor', 'unit', 'program', 'level', 'semester'];

    public function students()
    {
        return $this->belongsToMany(User::class)->withPivot('level');
    }

    /**
     * Human phrasing for a level: "100 level" for numeric levels,
     * "Masters" for the level-less Master's programme.
     */
    public static function levelLabel(?string $level): string
    {
        return is_numeric($level) ? $level . ' level' : (string) $level;
    }

    /**
     * Courses for a program at a level, grouped by semester/module in display order.
     */
    public static function forProgramLevel(string $program, string $level)
    {
        return static::where('program', $program)
            ->where('level', $level)
            ->orderBy('id')
            ->get()
            ->groupBy('semester')
            ->sortBy(fn ($courses, $semester) => array_search($semester, self::SEMESTER_ORDER));
    }
}
