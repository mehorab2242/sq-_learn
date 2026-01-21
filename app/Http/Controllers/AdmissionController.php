<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    //Show the total number of admissions
   public function totalAdmission(): JsonResponse
   {
        $count = Admission::all()->count();
        return response()->json(['total_admissions' => $count]);
   }

   //Show all the columns from admissions where the patient was admitted and discharged on the same day.
   public function sameDateDischarge(): JsonResponse
   {
       $admission = Admission::whereColumn('admission_date', 'discharge_date')->get();
       return response()->json($admission);
   }
   //Show the patient id and the total number of admissions for patient_id 5.
    public function specId():JsonResponse
    {
        $admission = Admission::where('patient_id', 5)->count();
        return response()->json([
            'patient_id' => 5,
            'total_admissions' => $admission]);
    }
}
