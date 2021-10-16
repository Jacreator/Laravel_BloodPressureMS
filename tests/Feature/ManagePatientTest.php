<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Patient;
use App\Http\Livewire\PatientCompontent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagePatientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_to_manage_page()
    {
        $this->get('/row')
            ->assertStatus(200);
    }

    public function test_can_see_create_button()
    {
        $this->get('/row')
            ->assertSee("Create")
            ->assertSuccessful();
    }

    public function test_download_csv_patient_page()
    {
        $this->get('/patient/export')
            ->assertDownload()
            ->assertSuccessful();
    }

    public function test_see_patients_and_order_by_desc()
    {
        
        User::factory()->count(3)->create();
        Patient::factory()
            ->count(5)->sequence(
            ['first_name' => 'James', 'last_name' => 'Adakole', 'email'=>'jambone.james82@gmail.com', 'age' => 25],
            ['first_name' => 'Able', 'last_name' => 'Adakole', 'email' => 'jambone.james82@gmail.com', 'age' => 24],
            ['first_name' => 'Zames', 'last_name' => 'Adakole', 'email' => 'jambone.james82@gmail.com', 'age' => 23],
            ['first_name' => 'Iames', 'last_name' => 'Adakole', 'email' => 'jambone.james82@gmail.com', 'age' => 22],
            ['first_name' => 'Lames', 'last_name' => 'Adakole', 'email' => 'jambone.james82@gmail.com', 'age' => 21]
        )->create();

        $this->get('/row')
            ->assertSee('James')
            ->assertSeeInOrder([
                'Zames',
                'Lames',
                'Iames',
            ])->assertSuccessful();
    }

    public function test_cannot_see_deleted_patient()
    {
        User::factory()->count(3)->create();
        Patient::factory()->delete()->create(
            ['first_name' => 'Bad', 'last_name' => 'things', 'email' => 'examp@ex.com', 'age' => 20]
        );

        $this->get('/row')->assertDontSee('Bad');
    }

    public function test_see_all_three_action_button()
    {
        User::factory()->count(3)->create();
        Patient::factory()->count(5)->create();
        $this->get('/row')
            ->assertSee("Edit")
            ->assertSee("Add BPRs")
            ->assertSee("Delete")
            ->assertSuccessful();
    }

    public function test_can_create_patient()
    {
        User::factory()->count(5)->create();

        Livewire::test(PatientCompontent::class)
            ->set([
            'first_name' => 'James',
            'last_name' => 'Adakole',
            'email' => 'jambone.james82@gmail.com',
            'gender' => 'male',
            'dob' => date('Y-m-d'),
            'dataId' => User::all()->random()->id,
            ])
            ->call('store');

        $this->assertTrue(Patient::where([
            'first_name' => 'James',
            'last_name' => 'Adakole'])->exists());
    }

    function test_can_set_edit_parameters()
    {
        Livewire::test(PatientCompontent::class, ['first_name' => 'James'])
        ->assertSet('first_name', 'James');
        Livewire::test(PatientCompontent::class, ['last_name' => 'Adakole'])
        ->assertSet('last_name', 'Adakole');
        Livewire::test(PatientCompontent::class, ['dataId' => '1'])
        ->assertSet('dataId', '1');
    }

    public function test_validation_error()
    {
        Livewire::test(PatientCompontent::class)
            ->set([
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'gender' => '',
            'dob' => '',
            'dataId' => ''
            ])
            ->call('store')
            ->assertHasErrors([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'dob' => 'required',
        ]);
    }
}
