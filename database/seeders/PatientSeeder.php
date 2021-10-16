<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    private $patientData = [];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '2048M');
        // quantity that should be created
        $patientQuantity = 50000;

        // creation

        for ($i = 0; $i < $patientQuantity; $i++) {
            $patientData[] = [
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'gender' => rand(0,1) == 1 ? 'female' : 'male',
                'date_of_birth' => now(),
                'age' => 26,
                'user_id' => User::all()->random()->id,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($patientData, 1000);

        foreach ($chunks as $chunkData) {
            Patient::insert($chunkData);
        }
    }
}
