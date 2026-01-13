<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';
    protected $primaryKey = 'doctor_id';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'speciality'
    ];

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'attending_doctor_id', 'doctor_id');
    }
}
