<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/enroll', [EnrollmentController::class, 'create'])->name('enroll');
Route::post('/enroll', [EnrollmentController::class, 'store'])->name('enroll.store');

Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.authenticate');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth')->group(function () {
        Route::get('/list', [EnrollmentController::class, 'index'])->name('admin.list');
        Route::post('/enrollments/{id}/status', [EnrollmentController::class, 'updateStatus'])->name('admin.status.update');

        Route::get('/appointments', [AppointmentController::class, 'index'])->name('admin.appointments');
        Route::post('/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('admin.appointments.update');
    });
});
