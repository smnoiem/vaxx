<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Operator;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\VaccineCertificateController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Operator\RegistrationController as OperatorRegistrationController;
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
Route::name('front.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::name('registration.')->prefix('registration')->group(function () {

        Route::get('/', [RegistrationController::class, 'create'])->name('create');
        Route::post('/', [RegistrationController::class, 'store'])->name('store');

        Route::name('status.')->prefix('status')->group(function () {

            Route::get('/', [RegistrationController::class, 'statusForm'])->name('index');
            Route::post('/', [RegistrationController::class, 'showStatus'])->name('show');

        });

    });

    Route::get('/vaccine-card', [VaccineCardController::class, 'showForm'])->name('vaccine.card');

    Route::post('/vaccine-card', [VaccineCardController::class, 'generateVaccineCard'])->name('vaccine.card');

    Route::get('/vaccine-certificate', [VaccineCertificateController::class, 'showForm'])->name('vaccine.card');

    Route::post('/vaccine-certificate', [VaccineCertificateController::class, 'generateCertificate'])->name('vaccine.card');

});

Route::group(['middleware' => ['auth', 'role:1']], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('/', [Admin\DashboardController::class, 'index'])->name('index');

        Route::resource('centers', Admin\CenterController::class);

        Route::get('centers/{center}/update-vial-count', [Admin\CenterController::class, 'updateVial'])->name('centers.update-vial-count');

        Route::post('centers/{center}/update-vial-count', [Admin\CenterController::class, 'updateVialStore'])->name('centers.update-vial-count-store');

        Route::resource('users', Admin\UserController::class);

        Route::get('users/{user}/assign-center', [Admin\UserController::class, 'assignCenter'])->name('users.assign-center');

        Route::post('users/{user}/assign-center', [Admin\UserController::class, 'assignCenterStore'])->name('users.assign-center-store');

    });

});

Route::group(['middleware' => ['auth', 'role:2']], function () {

    Route::group(['prefix' => 'center', 'as' => 'operator.'], function () {

        Route::get('/', [Operator\DashboardController::class, 'index'])->name('index');

        Route::resource('centers', CenterController::class);

        Route::resource('registrations', OperatorRegistrationController::class);

        Route::get('registrations/{registration}/doses', [OperatorRegistrationController::class, 'getDoses'])->name('registrations.doses');

        Route::get('registrations/{registration}/doses/create', [OperatorRegistrationController::class, 'doseCreate'])->name('registrations.doses.create');

        Route::get('registrations/{registration}/doses/{dose}', [OperatorRegistrationController::class, 'markDoseAsTaken'])->name('registrations.doses.mark-as-taken');

        Route::post('registrations/{registration}/doses', [OperatorRegistrationController::class, 'doseStore'])->name('registrations.doses.store');

        Route::post('centers/{center}/update-vial-count', [CenterController::class, 'updateVialStore'])->name('centers.update-vial-count-store');

    });

});

require __DIR__ . '/auth.php';