<?php

namespace Database\Seeders;

use App\Models\BPReading;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BPReadingSeeder extends Seeder
{
    private $bPData = [];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // quantity that should be created
        $bPQuantity = 200;

        for ($i = 0; $i < $bPQuantity; $i++) {
            $bPData[] = [
                'readings' => rand(80, 200),
                'patient_id' => rand(1, 50000)
            ];
        }

        foreach ($bPData as $bp) {
            BPReading::insert($bp);
        }
    }
}
