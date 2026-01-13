<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            ['doctor_id' => 1, 'first_name' => 'Ayesha', 'last_name' => 'Rahman', 'speciality' => 'Cardiology'],
            ['doctor_id' => 2, 'first_name' => 'Tanvir', 'last_name' => 'Hossain', 'speciality' => 'Medicine'],
            ['doctor_id' => 3, 'first_name' => 'Nadia', 'last_name' => 'Islam', 'speciality' => 'Neurology'],
            ['doctor_id' => 4, 'first_name' => 'Sajid', 'last_name' => 'Khan', 'speciality' => 'Orthopedics'],
            ['doctor_id' => 5, 'first_name' => 'Farzana', 'last_name' => 'Akter', 'speciality' => 'Pediatrics'],
        ]);
    }
}
