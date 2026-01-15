<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/patients', [PatientController::class, 'index']);
Route::get('/patients/female', [PatientController::class, 'femalePatients']);
Route::get('/patients/fullname', [PatientController::class, 'patientFullName']);
Route::get('/patients/male', [PatientController::class, 'malePatients']);
Route::get('/patients/no-allergies', [PatientController::class, 'noAllergies']);
Route::get('/patients/first-name-c', [PatientController::class, 'firstNameStartsWithC']);
Route::get('/patients/weight-range', [PatientController::class, 'weightRange']);
Route::get('/patients/update-allergies', [PatientController::class, 'updateAllergies']);
Route::get('/patients/full-name', [PatientController::class, 'fullName']);
Route::get('/patients/tallest-patient', [PatientController::class, 'tallestPatient']);
