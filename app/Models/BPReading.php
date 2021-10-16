<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPReading extends Model
{
    use HasFactory;

    protected $table = 'BPReadings';

    protected $fillable = [
        'readings',
        'patient_id'
    ];
}
