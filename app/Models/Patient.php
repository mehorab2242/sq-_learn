<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'patient_id';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'city',
        'province_id',
        'allergies',
        'height',
        'weight'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function province()
    {
        return $this->belongsTo(ProvinceName::class, 'province_id', 'province_id');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'patient_id', 'patient_id');
    }
}
