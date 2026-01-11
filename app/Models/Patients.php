<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    // Table name (optional if Laravel's naming convention is followed)
    protected $table = 'patients';

    // Primary key is not 'id'
    protected $primaryKey = 'patient_id';

    // Primary key is not auto-incrementing
    public $incrementing = false;

    // Primary key type
    protected $keyType = 'integer';

    // Mass assignable fields
    protected $fillable = [
        'patient_id',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'city',
        'province_id',
        'allergies',
        'height',
        'weight',
    ];

    // Optional: If you want date casting
    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
    ];

    // Optional: Accessor for full name
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
