<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('province_names')->upsert([
            ['province_id' => 'BG', 'province_name' => 'Bogura'],
            ['province_id' => 'BR', 'province_name' => 'Barishal'],
            ['province_id' => 'CT', 'province_name' => 'Chattogram'],
            ['province_id' => 'CU', 'province_name' => 'Cumilla'],
            ['province_id' => 'DN', 'province_name' => 'Dhaka'],
            ['province_id' => 'DP', 'province_name' => 'Dinajpur'],
            ['province_id' => 'FN', 'province_name' => 'Feni'],
            ['province_id' => 'GA', 'province_name' => 'Gazipur'],
            ['province_id' => 'JS', 'province_name' => 'Jessore'],
            ['province_id' => 'KH', 'province_name' => 'Khulna'],
            ['province_id' => 'MY', 'province_name' => 'Mymensingh'],
            ['province_id' => 'NA', 'province_name' => 'Narayanganj'],
            ['province_id' => 'NK', 'province_name' => 'Noakhali'],
            ['province_id' => 'PB', 'province_name' => 'Pabna'],
            ['province_id' => 'RJ', 'province_name' => 'Rajshahi'],
            ['province_id' => 'RP', 'province_name' => 'Rangpur'],
            ['province_id' => 'SY', 'province_name' => 'Sylhet'],
            ['province_id' => 'TG', 'province_name' => 'Tangail'],
        ], ['province_id'], ['province_name']);
    }
}
