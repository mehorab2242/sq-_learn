<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('patients')->group(function () {
    Route::get('/male', [PatientController::class, 'malePatients']);
    Route::get('/no-allergies', [PatientController::class, 'noAllergies']);
    Route::get('/first-name-c', [PatientController::class, 'firstNameStartsWithC']);
    Route::get('/weight-range', [PatientController::class, 'weightRange']);
    Route::get('/update-allergies', [PatientController::class, 'updateAllergies']);
    Route::get('/full-name', [PatientController::class, 'fullName']);
    Route::get('/provinces', [PatientController::class, 'patientProvinceNames']);
    Route::get('/born-in-2010', [PatientController::class, 'bornIn2010Count']);
    Route::get('/tallest-patient', [PatientController::class, 'tallestPatient']);
    Route::get('/specific-id', [PatientController::class, 'specificID']);
    Route::get('/spec-city', [PatientController::class, 'specCity']);
    Route::get('/height-weight', [PatientController::class, 'heightWeight']);
});

Route::prefix('admissions')->group(function () {
    Route::get('/totalAdmission', [AdmissionController::class, 'totalAdmission']);
    Route::get('/sameDateDischarge', [AdmissionController::class, 'sameDateDischarge']);
    Route::get('/specId', [AdmissionController::class, 'specId']);
});

