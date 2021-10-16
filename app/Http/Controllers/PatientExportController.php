<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PatientsExport;
use Maatwebsite\Excel\Facades\Excel;

class PatientExportController extends Controller
{
    public function exportPatient()
    {
        ini_set('memory_limit', '2048M');
        return Excel::download(new PatientsExport, 'patient_records.xlsx');
    }
}
