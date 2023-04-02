<?php

use App\Http\Controllers\Admin\CenterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\HomeController;
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
Route::name('front.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::name('registration.')->prefix('registration')->group(function() {

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

      Route::get('/', [DashboardController::class, 'index'])->name('index');

      Route::resource('centers', CenterController::class);

      Route::get('centers/{center}/update-vial-count', [CenterController::class, 'updateVial'])->name('centers.update-vial-count');

      Route::post('centers/{center}/update-vial-count', [CenterController::class, 'updateVialStore'])->name('centers.update-vial-count-store');

      Route::resource('users', UserController::class);

      Route::get('users/{user}/assign-center', [UserController::class, 'assignCenter'])->name('users.assign-center');

      Route::post('users/{user}/assign-center', [UserController::class, 'assignCenterStore'])->name('users.assign-center-store');
  
    });
  
});

Route::group(['middleware' => ['auth', 'role:2']], function () {

    Route::group(['prefix' => 'center', 'as' => 'center.'], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Route::resource('centers', CenterController::class);

        // Route::get('centers/{center}/update-vial-count', [CenterController::class, 'updateVial'])->name('centers.update-vial-count');

        // Route::post('centers/{center}/update-vial-count', [CenterController::class, 'updateVialStore'])->name('centers.update-vial-count-store');

        // Route::resource('users', UserController::class);

        // Route::get('users/{user}/assign-center', [UserController::class, 'assignCenter'])->name('users.assign-center');

        // Route::post('users/{user}/assign-center', [UserController::class, 'assignCenterStore'])->name('users.assign-center-store');
  
    });
  
});

require __DIR__ . '/auth.php';