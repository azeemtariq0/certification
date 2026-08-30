<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

// Public Website & Company Certification Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// Management System / Company Verification Routes
Route::get('/verify', [PublicController::class, 'verify'])->name('verify');
Route::post('/verify', [PublicController::class, 'apiSearch'])->name('verify.search');
Route::get('/verify/{certificate}/print', [PublicController::class, 'certificatePrint'])->name('verify.print');

// Training & Auditor Verification Routes (Dedicated)
Route::get('/verify-training', [PublicController::class, 'verifyTraining'])->name('verify.training');
Route::post('/verify-training', [PublicController::class, 'apiSearchTraining'])->name('verify.training.search');
Route::get('/verify/training/{code}', [PublicController::class, 'directVerifyTraining'])->name('verify.training.direct');
Route::get('/verify/training/{trainingCertificate}/print', [PublicController::class, 'trainingPrint'])->name('verify.training.print');

// Admin Auth Routes
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

// Admin Panel Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('certificates', App\Http\Controllers\Admin\CertificateController::class);
    Route::resource('training-certificates', App\Http\Controllers\Admin\TrainingCertificateController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
});
