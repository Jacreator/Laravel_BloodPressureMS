<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/row', function () {
    return view('welcome');
})->name('manage-patient');

Route::get('/', function () {
    return view('livewire.row');
});

Route::get('/patient/export', [PatientExportController::class, 'exportPatient'])->name('export-patient');