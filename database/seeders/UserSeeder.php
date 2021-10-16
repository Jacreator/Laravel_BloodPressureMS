<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $userData = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // quantity that should be created
        $userQuantity = 200;

        for ($i = 0; $i < $userQuantity; $i++) {
            $userData[] = [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ];
        }

        foreach ($userData as $user) {
            User::insert($user);
        }
    }
}
