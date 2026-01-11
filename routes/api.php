<?php

use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
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
