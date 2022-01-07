<?php

use App\Http\Controllers\VaccineCertificateController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VaccineCardController;
use App\Http\Controllers\VaccineStatusController;
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

Route::get('/', function () {
    return view('home'); // Provides links for other public routes
});

Route::get('/registration', [RegistrationController::class, 'create'])->name('registration.create');

Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

Route::get('/vaccine-status', [VaccineStatusController::class, 'showForm'])->name('vaccine.status');

Route::post('/vaccine-status', [VaccineStatusController::class, 'showVaccineStatus'])->name('vaccine.status');

Route::get('/vaccine-card', [VaccineCardController::class, 'showForm'])->name('vaccine.card');

Route::post('/vaccine-card', [VaccineCardController::class, 'generateVaccineCard'])->name('vaccine.card');

Route::get('/vaccine-certificate', [VaccineCertificateController::class, 'showForm'])->name('vaccine.card');

Route::post('/vaccine-certificate', [VaccineCertificateController::class, 'generateCertificate'])->name('vaccine.card');
