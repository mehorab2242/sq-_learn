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

Route::get('/patients/male', [PatientController::class, 'malePatients']);
Route::get('/patients/no-allergies', [PatientController::class, 'noAllergies']);
Route::get('/patients/first-name-c', [PatientController::class, 'firstNameStartsWithC']);
Route::get('/patients/weight-range', [PatientController::class, 'weightRange']);
Route::get('/patients/update-allergies', [PatientController::class, 'updateAllergies']);
Route::get('/patients/full-name', [PatientController::class, 'fullName']);
Route::get('/patients/provinces', [PatientController::class, 'patientProvinceNames']);
Route::get('/patients/born-in-2010', [PatientController::class, 'bornIn2010Count']);
Route::get('/patients/tallest-patient', [PatientController::class, 'tallestPatient']);
Route::get('/patients/specific-id', [PatientController::class, 'specificID']);

Route::get('/admissions/totalAdmission', [AdmissionController::class, 'totalAdmission']);
Route::get('/admissions/sameDateDischarge', [AdmissionController::class, 'sameDateDischarge']);
Route::get('/admissions/specId', [AdmissionController::class, 'specId']);

