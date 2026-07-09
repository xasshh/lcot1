<?php

namespace App\Support;

/**
 * Structured Monday–Saturday timetable grid, stored as JSON in the existing
 * users.course_timetable / users.exam_timetable text columns.
 *
 * Older records hold free text (pipe-separated lines); decode() returns null
 * for those so callers can fall back to the legacy renderer.
 */
class Timetable
{
    public const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    public const FIELDS = ['time', 'course', 'venue'];

    /**
     * @return array<string, array{time:string,course:string,venue:string}>|null
     *         Full six-day grid, or null when the value is empty/legacy text.
     */
    public static function decode(?string $raw): ?array
    {
        if (! $raw) {
            return null;
        }

        $data = json_decode($raw, true);

        if (! is_array($data) || array_intersect(self::DAYS, array_keys($data)) === []) {
            return null;
        }

        $grid = [];
        foreach (self::DAYS as $day) {
            $row = is_array($data[$day] ?? null) ? $data[$day] : [];
            foreach (self::FIELDS as $field) {
                $grid[$day][$field] = trim((string) ($row[$field] ?? ''));
            }
        }

        return $grid;
    }

    /**
     * Build the storage JSON from submitted form input.
     * Returns null when every cell is blank (column stays empty).
     */
    public static function encode(?array $input): ?string
    {
        $grid = [];
        $hasContent = false;

        foreach (self::DAYS as $day) {
            $row = is_array($input[$day] ?? null) ? $input[$day] : [];
            foreach (self::FIELDS as $field) {
                $value = trim((string) ($row[$field] ?? ''));
                $grid[$day][$field] = $value;
                $hasContent = $hasContent || $value !== '';
            }
        }

        return $hasContent ? json_encode($grid) : null;
    }

    /**
     * Days that have at least one filled cell.
     */
    public static function filledDays(array $grid): array
    {
        return array_filter($grid, fn ($row) => implode('', $row) !== '');
    }
}
