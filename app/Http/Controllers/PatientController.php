<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // Get all patients
        $patients = Patients::all();
        dd($patients); // Dump all patients to browser
    }

    public function femalePatients()
    {
        // Query example: Only female patients
        $females = Patients::where('gender', 'F')->get();
        dd($females);
    }

    public function patientFullName()
    {
        // Query example: Select full name
        $patients = Patients::all()->map(function ($patient) {
            return [
                'patient_id' => $patient->patient_id,
                'full_name' => $patient->full_name,
                'city' => $patient->city,
            ];
        });
        dd($patients);
    }
    // Show first name, last name, and gender of patients whose gender is 'M'
    public function malePatients()
    {
        $patients = Patients::where('gender', 'M')
            ->select('first_name', 'last_name', 'gender')
            ->get();

        return response()->json($patients);
    }

    // Show first name and last name of patients who does not have allergies. (null)
    public function noAllergies()
    {
        $patients = Patients::whereNull('allergies')
            ->select('first_name', 'last_name')
            ->get();

        return response()->json($patients);
    }

    // Show first name of patients that start with the letter 'C'
    public function firstNameStartsWithC()
    {
        $patients = Patients::where('first_name', 'like', 'C%')
            ->select('first_name')
            ->get();

        return response()->json($patients);
    }

    // Show first name and last name of patients that weight within the range of 100 to 120 (inclusive)
    public function weightRange()
    {
        $patients = Patients::whereBetween('weight', [100, 120])
            ->select('first_name', 'last_name', 'weight')
            ->get();

        return response()->json($patients);
    }

    // Update the patients table for the allergies column. If the patient's allergies is null then replace it with 'NKA'
    public function updateAllergies()
    {
        Patients::whereNull('allergies')->update(['allergies' => 'NKA']);

        $patients = Patients::all();
        return response()->json($patients);
    }

    // Show first name and last name concatinated into one column to show their full name.
    public function fullName()
    {
        $patients = Patients::all()->map(function ($patient) {
            return [
                'full_name' => $patient->first_name . ' ' . $patient->last_name,
                'gender' => $patient->gender,
                'weight' => $patient->weight,
            ];
        });

        return response()->json($patients);
    }
}
