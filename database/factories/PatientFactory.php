<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->word(),
            'gender' => rand(0,1) == 0 ? 'Male' : 'Female',
            'email' => $this->faker->unique()->safeEmail(),
            'date_of_birth' => $this->date ?? $this->faker->date(),
            'age' => $this->faker->numberBetween(20, 90),
            'user_id' => User::all()->random()->id
        ];
    }

    public function delete()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => $this->faker->date(),
            ];
        });
    }
}
