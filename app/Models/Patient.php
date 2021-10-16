<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    // soft delete  
    protected $date = ['deleted_at'];

    protected $fillable = [
        'first_name', 'last_name',
        'gender', 'date_of_birth',
        'email', 'age', 'user_id',

    ];

    public function getBPReadings()
    {
        return $this->hasMany(BPReading::class, 'patient_id');
    }
}
