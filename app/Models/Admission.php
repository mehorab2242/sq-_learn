<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $table = 'admissions';

    public $timestamps = false;

    // Composite primary key workaround
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'patient_id',
        'admission_date',
        'discharge_date',
        'diagnosis',
        'attending_doctor_id'
    ];

    protected $casts = [
        'admission_date' => 'date',
        'discharge_date' => 'date'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'attending_doctor_id', 'doctor_id');
    }
}
