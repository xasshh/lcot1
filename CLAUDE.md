# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Install dependencies
composer install           # composer.json pins platform PHP to 8.4
npm install

# Environment setup
cp .env.example .env
php artisan key:generate
php artisan storage:link   # required for profile photo uploads

# Database
php artisan migrate
php artisan db:seed        # creates default super_admin account (see below)

# Development servers (run both concurrently)
php artisan serve
npm run dev

# Production assets
npm run build

# Tests
php artisan test
./vendor/bin/phpunit --filter TestClassName

# Code style (Laravel Pint)
./vendor/bin/pint
```

## Required Environment Variables

Beyond the standard Laravel `.env.example`, this project needs:

```
PAYSTACK_PUBLIC_KEY=
PAYSTACK_SECRET_KEY=
PAYSTACK_PAYMENT_URL=https://api.paystack.co
MERCHANT_EMAIL=
ADMIN_NOTIFICATION_EMAIL=   # receives new-student registration emails; defaults to abujalifecollege@gmail.com
```

Production sends mail through Gmail SMTP — the `MAIL_*` values in `.env.example` (mailpit) are dev-only defaults.

## Architecture

**Laravel 10** application for Abuja Life College of Theology. Three distinct surface areas:

### 1. Public Website
Informational pages (gallery, faculty, history, management, mission-vision-values, etc.) via `PageController` → Blade views in `resources/views/`. Home page: `resources/views/welcome.blade.php`.

### 2. Student Portal (auth-gated)
- **Auth**: Laravel Breeze at `/login`, `/register`. Registration collects academic fields beyond the Breeze defaults — matric number (unique), program center, **programme track**, year admitted — all stored on `User`. The track select maps to the keys of `Course::PROGRAMS` (`bachelor` | `special_executive` | `masters`); signup stores the key in `users.program`, the label in `users.program_taken`, and defaults `users.level` to the track's first level.
- **Email verification** is required (`MustVerifyEmail`). The verification email is customized via `VerifyEmail::toMailUsing()` in `AppServiceProvider` → `App\Mail\VerifyEmailMail`. Registration also fires a `NewStudentRegisteredNotification` mailable to the admin. Both sends are wrapped in try/catch — registration succeeds (and logs an error) even if mail fails.
- **Dashboard** (`/dashboard`): `DashboardController` → `resources/views/dashboard.blade.php` with user + registered courses (incl. lecturer, per-level), uploaded results, and a "registration pending" prompt when the student has no courses at their current level.
- **Course registration** (`/course-registration`, `CourseRegistrationController`): students tick courses for their programme + **current level only** (grouped by semester/module/masters group). Registration is **one-shot per level**: once submitted, the selection is locked — the form redirects to the dashboard (read-only list with a "Locked" badge) and re-submits are rejected server-side. Pivot rows carry the level (`course_user.level`), so each level's registration is kept. Corrections go through the admin student-edit screen. Legacy accounts without a valid `program` key pick their track here first. Level progression is admin-driven: staff bump `users.level`, which unlocks registration for the new level.
- **Profile** (`/profile`): `ProfileController` handles name/email, password, photo upload (`storage/app/public/uploads/images`), and account deletion.

### 3. Admin Panel
A **custom-built** admin panel at `/admin` — there is no third-party admin package. Controllers are in `app/Http/Controllers/Admin/` and extend the standard Laravel `Controller`; views are in `resources/views/admin/`.

**Auth**: The admin panel uses the same `web` guard as students (dedicated login page at `/admin/login`). Access is controlled by the `role` column on `User`:
- `student` — default portal user
- `staff` / `admin` — can access `/admin/*` (checked by `AdminMiddleware` via `isStaff()`)
- `super_admin` — additionally can access staff management routes (checked by `SuperAdminMiddleware`)

The seeder (`php artisan db:seed`) creates: `admin@lifeabujacollegeoftheology.com` / `password123` with role `super_admin`.

**Admin routes** (prefix `/admin`, middleware `auth` + `admin`):
- Dashboard, Students (CRUD), Courses (CRUD incl. program/level/semester), Timetable (per-student text fields)
- Account/password change — all staff roles
- Staff management and **result uploads** (`/admin/results`, `Admin\ResultController`) — `super_admin` only

### User Model is the Central Record
`app/Models/User.php` stores both auth and student-academic data in one table. There is also a legacy `Student` model/table that is functionally unused — student data lives on `User`.

Timetable data (`course_timetable`, `exam_timetable`) lives in text columns on `User`, not in the legacy `Timetable` model/table (which exists but is not wired to the admin panel). New records hold a **Monday–Saturday JSON grid** (`{day: {time, course, venue}}`) managed by `App\Support\Timetable` (encode/decode/filledDays); the admin Timetables screen fills a preset grid per student and `resources/views/partials/timetable.blade.php` renders it on the dashboard (table on desktop, stacked day cards on mobile). Older records are free text — `Timetable::decode()` returns null for those and the partial falls back to the legacy pipe-separated rendering.

### Payment Flows (Paystack)
Two separate flows, both download a PDF from `public/forms/` on success:

- **Accreditation** (`POST /pay-for-form`): `PaymentController` uses the `Paystack` facade (`unicodeveloper/laravel-paystack`). Program name stored in session; PDF served as `public/forms/{program}.pdf`.
- **Reference forms** (`POST /reference/pay`): `ReferenceFormController` calls the Paystack API directly via `Http::withToken()`. Program name stored in Paystack metadata; mapped to a specific filename (e.g. `'Bachelor of Theology' => 'bachelor_of_theology.pdf'`) in the callback.

### Data Model
- `User` ↔ `Course`: many-to-many via `course_user` pivot, which carries a `level` column (the level the student registered the course at)
- `User` → `Payment`: one-to-many
- `User` → `Result`: one-to-many. `results` mirrors the college's "RESULT CHECK LIST" sheet: one row per course score, keyed by student + session (e.g. `2025/2026`) + level + `course_title` (a snapshot, so results survive course edits); `semester` groups rows into the checklist's semester/module tables.
- `Course` carries the programme catalogue: `program` (key of `Course::PROGRAMS`), `level`, `semester` (semester / module / masters group — ordering in `Course::SEMESTER_ORDER`), `unit` (decimal — masters has 1½-unit courses). Levels per programme (`Course::PROGRAM_LEVELS`): bachelor 100–500, special_executive 100–300, masters has **no numeric levels** — it is a single stage stored as the level string `Masters`. Use `Course::levelLabel()` for user-facing phrasing ("100 level" vs "Masters"). The full catalogue from the college's course-list documents (with lecturers) is seeded by `CourseSeeder`; rows are keyed on program+level+semester+title so re-seeding is safe.

### Frontend Stack
Blade + Tailwind CSS + Alpine.js, compiled with Vite. Layouts: `resources/views/layouts/` (app, guest, admin, header, footer, navigation). Blade components: `resources/views/components/`.

## Shared-Hosting Deployment Artifacts

The repo root contains files that only matter for the cPanel-style shared host the site deploys to — don't mistake them for application code:
- `.htaccess` — Apache security headers, compression, and caching for the hosted site
- `test-link.php` — standalone script to create the `public/storage` symlink on hosts without SSH (replaces `php artisan storage:link`)
- `sitemap.xml` — hand-maintained sitemap served from the web root
