<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Static Information Pages
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms-and-conditions', 'pages.terms')->name('terms');
Route::view('/return-policy', 'pages.refund')->name('refund');

// Enrollment Routes
Route::get('/enroll', [EnrollmentController::class, 'create'])->name('enroll');
Route::post('/enroll', [EnrollmentController::class, 'store'])->name('enroll.store');

Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.authenticate');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/list', [EnrollmentController::class, 'index'])->name('admin.list');
        Route::post('/enrollments/{id}/status', [EnrollmentController::class, 'updateStatus'])->name('admin.status.update');
        
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('admin.appointments');
        Route::post('/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('admin.appointments.update');

        Route::get('/clients', [\App\Http\Controllers\ReportController::class, 'clients'])->name('admin.clients');
        Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('admin.reports');
        
        Route::get('/migrate', function () {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            return redirect()->back()->with('success', 'Database updated successfully on live server!');
        })->name('admin.migrate');

        Route::get('/clear-cache', function () {
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            return redirect()->back()->with('success', 'আপডেটের পর ক্যাশ সফলভাবে ক্লিয়ার করা হয়েছে! (Cache Cleared)');
        })->name('admin.clear-cache');
    });
});
