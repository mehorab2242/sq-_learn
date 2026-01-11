<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvinceName extends Model
{
    protected $table = 'province_names';

    protected $primaryKey = 'province_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'province_id',
        'province_name'
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class, 'province_id', 'province_id');
    }
}
