<?php

namespace Database\Factories;

use App\Models\BPReading;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class BPReadingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BPReading::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'readings' => rand(80, 200)
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
