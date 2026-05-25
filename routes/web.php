<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AcredController;
use App\Http\Controllers\ReferenceFormController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/center', [PageController::class, 'center'])->name('center');
Route::get('/faculty', [PageController::class, 'faculty'])->name('faculty');
Route::get('/history', [PageController::class, 'history'])->name('history');
Route::get('/management', [PageController::class, 'management'])->name('management');
Route::get('/non-teaching-staff', [PageController::class, 'nonTeachingStaff'])->name('nonTeachingStaff');
Route::get('/payment', [PageController::class, 'payment'])->name('payment');
Route::get('/rectors-desk', [PageController::class, 'rectorsDesk'])->name('rectorsDesk');
Route::get('/reference', [PageController::class, 'reference'])->name('reference');
Route::get('/governing-council', [PageController::class, 'governingCouncil'])->name('governingCouncil');
Route::get('/acred', [AcredController::class, 'index'])->name('acred');


Route::post('/pay-for-form', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);



Route::post('/reference/pay', [ReferenceFormController::class, 'pay'])->name('reference.pay');
Route::get('/reference/callback', [ReferenceFormController::class, 'handleGatewayCallback'])->name('reference.callback');


Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\TimetableController as AdminTimetableController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin login page — uses same auth guard as students; redirects staff/admin to /admin after login
Route::get('/admin/login', fn () => auth()->check()
    ? redirect()->route('admin.dashboard')
    : view('admin.login')
)->middleware('guest')->name('admin.login');

// Admin / Staff routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}/edit', [AdminStudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [AdminStudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [AdminStudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/courses', [AdminCourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [AdminCourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/timetable', [AdminTimetableController::class, 'index'])->name('timetable.index');
    Route::put('/timetable/{student}', [AdminTimetableController::class, 'update'])->name('timetable.update');

    // Account / password change — available to ALL staff & admin
    Route::get('/account', [AdminAccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/password', [AdminAccountController::class, 'updatePassword'])->name('account.password');

    // Staff management — super_admin only
    Route::middleware('super_admin')->group(function () {
        Route::get('/staff', [AdminStaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [AdminStaffController::class, 'create'])->name('staff.create');
        Route::post('/staff', [AdminStaffController::class, 'store'])->name('staff.store');
        Route::delete('/staff/{staff}', [AdminStaffController::class, 'destroy'])->name('staff.destroy');
    });
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');
});

require __DIR__.'/auth.php';
