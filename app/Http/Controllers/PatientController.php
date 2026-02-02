<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;

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

    public function specificID(): JsonResponse
    {
        $patient = Patient::whereIn('patient_id', [1, 45, 534, 879, 1000])->get();
        return response()->json($patient);
    }

    //Based on the cities that our patients live in, show unique cities that are in province_id 'BR'
    public function specCity(): JsonResponse
    {
        $city = Patient::select('city')
            ->where('province_id', 'BR')
            ->distinct('city')
            ->get();
        return response()->json($city);
    }

    //Write a query to find the first_name, last name and birth date of patients who has height greater than 160 and weight greater than 70
    public function heightWeight(): JsonResponse
    {
        $patient = Patient::query()
            ->select('first_name', 'last_name', 'birth_date')
            ->where('height', '>', 160)
            ->where('weight', '>', 70)
            ->get();
        return response()->json($patient);
    }

    // Show unique birth years from patients in ascending order
    // SQL Query:
    // SELECT DISTINCT YEAR(birth_date) as year
    // FROM patients
    // ORDER BY year ASC
    public function uniqueBirthYears(): JsonResponse
    {
        $years = Patient::selectRaw('YEAR(birth_date) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');

        return response()->json($years);
    }

    // Show unique first names that appear only once in the patients table
    // SQL Query:
    // SELECT first_name
    // FROM patients
    // GROUP BY first_name
    // HAVING COUNT(first_name) = 1
    public function uniqueFirstNames(): JsonResponse
    {
        $names = Patient::select('first_name')
            ->groupBy('first_name')
            ->havingRaw('COUNT(first_name) = 1')
            ->orderBy('first_name')
            ->pluck('first_name');

        return response()->json($names);
    }

    // Show patient_id and first_name where first_name starts and ends with 's' and is at least 6 characters long
    // SQL Query:
    //SELECT patient_id, first_name
    //FROM patients
    //WHERE first_name LIKE 's%s'
    //AND len(first_name) >= 6;
    public function namesStartEndWithS(): JsonResponse
    {
        $patients = Patient::select('patient_id', 'first_name')
            ->where('first_name', 'LIKE', 's%s')
            ->whereRaw('LENGTH(first_name) >= 6')
            ->get();

        return response()->json($patients);
    }

    // Display every patient's first_name ordered by length of the name and then alphabetically
    // SQL Query:
    // SELECT first_name
    // FROM patients
    // ORDER BY LEN(first_name), first_name
    public function orderedFirstNames(): JsonResponse
    {
        $patients = Patient::select('first_name')
            ->orderByRaw('LENGTH(first_name), first_name')
            ->pluck('first_name');

        return response()->json($patients);
    }
    //Show the total amount of male patients and the total amount of female patients in the patients table. Display the two results in the same row.
    //SQL Query:
    //SELECT
    //(SELECT count(*) FROM patients WHERE gender='M') AS male_count,
    //(SELECT count(*) FROM patients WHERE gender='F') AS female_count;
    public function genderCount(): JsonResponse
    {
        $maleCount = Patient::where('gender', 'M')->count();
        $femaleCount = Patient::where('gender', 'F')->count();

        return response()->json([
            'male_count' => $maleCount,
            'female_count' => $femaleCount
        ]);
    }

    // Show first name, last name and role of every person that is either patient or doctor
    // The roles are either "Patient" or "Doctor"
    // SQL Query for patients:
    // SELECT first_name, last_name, 'Patient' as role FROM patients
    // UNION ALL
    // SELECT first_name, last_name, 'Doctor' as role FROM doctors
    public function peopleWithRoles(): JsonResponse
    {
        // Get all patients with 'Patient' role
        $patients = Patient::selectRaw("first_name, last_name, 'Patient' as role")->get();

        // Get all doctors with 'Doctor' role
        $doctors = Doctor::selectRaw("first_name, last_name, 'Doctor' as role")->get();

        // Combine the collections
        $people = $patients->concat($doctors);

        return response()->json($people);
    }

    // Show the city and the total number of patients in the city
    // Ordered from most to least patients and then by city name ascending
    // SQL Query:
//     SELECT city, COUNT(*) as patient_count
//     FROM patients
//     GROUP BY city
//     ORDER BY patient_count DESC, city ASC
    public function patientsByCity(): JsonResponse
    {
        $cityCounts = Patient::selectRaw('city, COUNT(*) as patient_count')
            ->groupBy('city')
            ->orderBy('patient_count', 'desc')
            ->orderBy('city')
            ->get();

        return response()->json($cityCounts);
    }
}
