<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Http\Response;
use App\Http\Livewire\PatientTable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_button_for_generating_csv()
    {
        $this->get('/')
            ->assertSee("Generate Excel")
            ->assertSuccessful();
    }

    public function test_contains_livewire_component(){
        $this->get('/')
            ->assertSeeLivewire('patient-table')
            ->assertSuccessful();
    }

    public function test_has_data_in_compontent(){
        Livewire::test(PatientTable::class, ['First Name' => 'L1aERXMnLa'])
            ->assertNotSet('First Name', 'L1aERXMnLa')
            ->assertSuccessful();
    }

    public function test_has_internet_connection(){
        $response = null;
        system("ping -c 1 google.com", $response);
        if ($response == 0) {
            $this->get('/')->assertSuccessful();
        }
    }

    public function test_can_see_manage_patient()
    {
        $this->get('/')
            ->assertSee("Manage Patient")
            ->assertSuccessful();
    }

    public function test_download_csv_home_page()
    {
         $this->get('/patient/export')
            ->assertDownload()
            ->assertSuccessful();
    }
}
