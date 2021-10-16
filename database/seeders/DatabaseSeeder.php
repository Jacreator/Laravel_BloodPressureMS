<?php

namespace Database\Seeders;

use App\Models\BPReading;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // make the foreign key checks null
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // dropping table data if present
        Patient::truncate();
        User::truncate();
        BPReading::truncate();

        // flush Event incase of mailing and other third party usage
        Patient::flushEventListeners();
        User::flushEventListeners();
        BPReading::flushEventListeners();
        


        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(BPReadingSeeder::class);
    }
}
