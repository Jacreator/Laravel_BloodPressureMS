<?php

namespace App\Http\Livewire;

use App\Models\BPReading as ModelsBPReading;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;

class PatientCompontent extends Component
{
    public $patientData;
    public $first_name;
    public $last_name;
    public $email;
    public $gender;
    public $dob;
    public $dataId;
    public $bPreports;
    public $reading;

    public function render()
    {
        $this->patientData = Patient::take(20)->orderBy('created_at', 'desc')->get();
        // dd($this->patientData);
        return view('livewire.patient-compontent');
    }

    public function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->gender = '';
        $this->dob = '';
    }

    public function store()
    {
        $validation = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'dob' => 'required'
        ]);
        Patient::create($this->dbReadyData($validation));

        $this->responseMessage('created');
    }

    public function edit(Patient $patient)
    {
        $this->dataId = $patient->id;
        $this->first_name = $patient->first_name;
        $this->last_name = $patient->last_name;
        $this->email = $patient->email;
        $this->gender = $patient->gender;
        $this->dob = $patient->date_of_birth;
    }

    public function add(Patient $patient)
    {
        $this->dataId = $patient->id;
        $this->first_name = $patient->first_name;
        $this->last_name = $patient->last_name;
        $this->email = $patient->email;
        $this->bPreports = ModelsBPReading::where('patient_id', $patient->id)->take(20)->orderBy('created_at', 'desc')->get();
    }

    public function update(Patient $patient)
    {
        $validation = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'dob' => 'required'
        ]);
        $patient->update($this->dbReadyData($validation));

        $this->responseMessage('updated');
    }

    public function storeBPs(Patient $patient)
    {
        $validation = $this->validate([
            'reading' => 'required',
        ]);
        ModelsBPReading::create([
            'readings' => $validation['reading'],
            'patient_id' => $patient->id
        ]);

        $this->responseMessage('Added');
    }

    public function delete(Patient $patient)
    {
        $patient->delete();
        session()->flash('message', 'Data Deleted Successfully.');
    }

    private function dbReadyData($validation)
    {
        return [
            'first_name' => $validation['first_name'],
            'last_name' => $validation['last_name'],
            'email' => $validation['email'],
            'gender' => $validation['gender'],
            'age' => getAge($validation['dob']),
            'date_of_birth' => $validation['dob'],
            'user_id' => User::all()->random()->id, // assuming to be a login user
        ];
    }

    private function responseMessage($action){
        session()->flash('message, Data '. $action.' Successfully.');
        $this->resetInputFields();
        $this->emit('userStore');
    }
}
