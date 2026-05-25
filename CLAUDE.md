# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Install dependencies
composer install
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
ADMIN_NOTIFICATION_EMAIL=   # receives new-student registration emails; defaults to info@lifeabujacollegeoftheology.com
```

## Architecture

**Laravel 10** application for Abuja Life College of Theology. Three distinct surface areas:

### 1. Public Website
Informational pages (gallery, faculty, history, management, etc.) via `PageController` → Blade views in `resources/views/`. Home page: `resources/views/welcome.blade.php`.

### 2. Student Portal (auth-gated)
- **Auth**: Laravel Breeze at `/login`, `/register`. Email verification is required (`MustVerifyEmail`). Registration also fires a `NewStudentRegisteredNotification` mailable to the admin.
- **Dashboard** (`/dashboard`): `DashboardController` → `resources/views/dashboard.blade.php` with user + enrolled courses.
- **Profile** (`/profile`): `ProfileController` handles name/email, password, photo upload (`storage/app/public/uploads/images`), and account deletion.

### 3. Admin Panel
A **custom-built** admin panel at `/admin` — there is no third-party admin package. Controllers are in `app/Http/Controllers/Admin/` and extend the standard Laravel `Controller`.

**Auth**: The admin panel uses the same `web` guard as students. Access is controlled by the `role` column on `User`:
- `student` — default portal user
- `staff` / `admin` — can access `/admin/*` (checked by `AdminMiddleware` via `isStaff()`)
- `super_admin` — additionally can access staff management routes (checked by `SuperAdminMiddleware`)

The seeder (`php artisan db:seed`) creates: `admin@lifeabujacollegeoftheology.com` / `password123` with role `super_admin`.

**Admin routes** (prefix `/admin`, middleware `auth` + `admin`):
- Dashboard, Students (CRUD), Courses (CRUD), Timetable (per-student text fields)
- Account/password change — all staff roles
- Staff management — `super_admin` only

### User Model is the Central Record
`app/Models/User.php` stores both auth and student-academic data in one table. There is also a legacy `Student` model/table that is functionally unused — student data lives on `User`.

Timetable data (`course_timetable`, `exam_timetable`) is stored as plain-text columns on `User`, not in the `Timetable` model/table (which exists but is not wired to the admin panel).

### Payment Flows (Paystack)
Two separate flows, both download a PDF from `public/forms/` on success:

- **Accreditation** (`POST /pay-for-form`): `PaymentController` uses the `Paystack` facade (`unicodeveloper/laravel-paystack`). Program name stored in session; PDF served as `public/forms/{program}.pdf`.
- **Reference forms** (`POST /reference/pay`): `ReferenceFormController` calls the Paystack API directly via `Http::withToken()`. Program name stored in Paystack metadata; mapped to a specific filename (e.g. `'Bachelor of Theology' => 'bachelor_of_theology.pdf'`) in the callback.

### Data Model
- `User` ↔ `Course`: many-to-many via `course_user` pivot
- `User` → `Payment`: one-to-many

### Frontend Stack
Blade + Tailwind CSS + Alpine.js, compiled with Vite. Layouts: `resources/views/layouts/` (app, guest, admin, header, footer, navigation). Blade components: `resources/views/components/`.
