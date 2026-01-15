<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(): JsonResponse
    {
        // Get all patients
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function femalePatients(): JsonResponse
    {
        // Query example: Only female patients
        $females = Patient::where('gender', 'F')->get();
        return response()->json($females);
    }

    public function patientFullName(): JsonResponse
    {
        // Query example: Select full name
        $patients = Patient::all()->map(function ($patient) {
            return [
                'patient_id' => $patient->patient_id,
                'full_name' => $patient->first_name . ' ' . $patient->last_name,
                'city' => $patient->city,
            ];
        });
        return response()->json($patients);
    }
    // Show first name, last name, and gender of patients whose gender is 'M'
    public function malePatients(): JsonResponse
    {
        $patients = Patient::where('gender', 'M')
            ->select('first_name', 'last_name', 'gender')
            ->get();

        return response()->json($patients);
    }

    // Show first name and last name of patients who does not have allergies. (null)
    public function noAllergies(): JsonResponse
    {
        $patients = Patient::where('allergies', 'NKA')
            ->select('first_name', 'last_name')
            ->get();

        return response()->json($patients);
    }

    // Show first name of patients that start with the letter 'C'
    public function firstNameStartsWithC(): JsonResponse
    {
        $patients = Patient::where('first_name', 'like', 'C%')
            ->select('first_name')
            ->get();

        return response()->json($patients);
    }

    // Show first name and last name of patients that weight within the range of 100 to 120 (inclusive)
    public function weightRange(): JsonResponse
    {
        $patients = Patient::whereBetween('weight', [100, 120])
            ->select('first_name', 'last_name', 'weight')
            ->get();

        return response()->json($patients);
    }

    // Update the patients table for the allergies column. If the patient's allergies is null then replace it with 'NKA'
    public function updateAllergies(): JsonResponse
    {
        Patient::whereNull('allergies')->update(['allergies' => 'NKA']);
        Patient::where('allergies', '')->update(['allergies' => 'NKA']);

        $patients = Patient::all();
        return response()->json($patients);
    }

    // Show first name and last name concatinated into one column to show their full name.
    public function fullName(): JsonResponse
    {
        $patients = Patient::all()->map(function ($patient) {
            return [
                'full_name' => $patient->first_name . ' ' . $patient->last_name,
                'gender' => $patient->gender,
                'weight' => $patient->weight,
            ];
        });
        return response()->json($patients);
    }

    // Show first name, last name, and the full province name of each patient.
    public function patientProvinceNames(): JsonResponse
    {
        $patients = Patient::with('province')
            ->get()
            ->map(function ($patient) {
                $provinceName = $patient->province ? $patient->province->province_name : null;
                return [
                    'first_name' => $patient->first_name,
                    'last_name' => $patient->last_name,
                    'province_name' => $provinceName,
                ];
            })
            ->values();

        return response()->json($patients);
    }

    // Show how many patients have a birth_date with 2010 as the birth year.
    public function bornIn2010Count(): JsonResponse
    {
        $count = Patient::whereBetween('birth_date', ['2010-01-01', '2010-12-31'])->count();

        return response()->json([
            'birth_year' => 2010,
            'count' => $count,
        ]);
    }

    // Show the first_name, last_name, and height of the patient with the greatest height.
    public function tallestPatient(): JsonResponse
    {
        $patient = Patient::query()
            ->select('first_name', 'last_name', 'height')
            ->orderByDesc('height')
            ->first();
        return response()->json($patient);
    }
    public function specificID():JsonResponse
    {
        $patient = Patient::whereIn('patient_id', [1, 45, 534, 879, 1000])->get();
        return response()->json($patient);
    }
}
