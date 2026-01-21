<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdmissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admissions')->insert([
            [
                'patient_id' => 1,
                'admission_date' => '2025-01-10',
                'discharge_date' => '2025-01-10',
                'diagnosis' => 'Fever',
                'attending_doctor_id' => 2,
            ],
            [
                'patient_id' => 2,
                'admission_date' => '2025-02-05',
                'discharge_date' => '2025-02-07',
                'diagnosis' => 'Migraine',
                'attending_doctor_id' => 3,
            ],
            [
                'patient_id' => 3,
                'admission_date' => '2025-03-20',
                'discharge_date' => '2025-03-20',
                'diagnosis' => 'Chest Pain',
                'attending_doctor_id' => 1,
            ],
            [
                'patient_id' => 5,
                'admission_date' => '2025-04-11',
                'discharge_date' => '2025-04-15',
                'diagnosis' => 'Fracture',
                'attending_doctor_id' => 4,
            ],
            [
                'patient_id' => 5,
                'admission_date' => '2025-05-01',
                'discharge_date' => '2025-05-03',
                'diagnosis' => 'Flu',
                'attending_doctor_id' => 2,
            ],
            [
                'patient_id' => 6,
                'admission_date' => '2025-05-01',
                'discharge_date' => '2025-05-03',
                'diagnosis' => 'Flu',
                'attending_doctor_id' => 2,
            ],
        ]);
    }
}
