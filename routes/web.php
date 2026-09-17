<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

    Route::middleware('auth')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // ADMIN ONLY
        Route::middleware('role:admin')->group(function () {
            Route::resource('doctors', DoctorController::class);
            Route::resource('medicines', MedicineController::class);
            Route::resource('users', UserController::class);
        });

        // ADMIN + DOCTOR
        Route::middleware('role:admin,doctor')->group(function () {
            Route::resource('prescriptions', PrescriptionController::class);
        });

        // ADMIN + RECEPTIONIST
        Route::middleware('role:admin,receptionist')->group(function () {
            Route::resource('payments', PaymentController::class);
        });

        // ALL STAFF
        Route::middleware('role:admin,doctor,receptionist')->group(function () {
            Route::resource('patients', PatientController::class);
            Route::resource('appointments', AppointmentController::class);
        });
});
