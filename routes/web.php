<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\EnrollmentController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/enroll', [EnrollmentController::class, 'create'])->name('enroll');
Route::post('/enroll', [EnrollmentController::class, 'store'])->name('enroll.store');

Route::get('/admin/list', [EnrollmentController::class, 'index'])->name('admin.list');
