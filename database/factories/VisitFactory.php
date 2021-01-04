<?php

namespace Database\Factories;

use App\Models\Visit;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date($format = 'Y-m-d'),
            'cost' => $this->faker->randomFloat($nbMaxDecimals = 6, $min = 0, $max = 999.99),
            'start_time' => $this->faker->time($format = 'H:i', $max = 'now'),
            'end_time' => $this->faker->time($format = 'H:i', $max = 'now'),
            'duration' => '1', 
            'patient_id' => Patient::factory(),
            'doctor_id' => Doctor::factory()
        ];
    }
}
