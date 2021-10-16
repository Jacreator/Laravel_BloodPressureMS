<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Patient;
use App\Models\BPReading;
use App\Http\Livewire\PatientCompontent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BPReadingTest extends TestCase
{
    public function test_can_add_patient_bprs()
    {
        User::factory()->count(5)->create();
        $patient = Patient::factory()->count(5)->create();

        Livewire::test(PatientCompontent::class)
            ->set([
                'reading' => '85'
            ])
            ->call('storeBPs', rand(1, 5));

        $this->assertTrue(BPReading::where([
            'readings' => '85'
        ])->exists());
    }
}
