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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');

});

require __DIR__.'/auth.php';
