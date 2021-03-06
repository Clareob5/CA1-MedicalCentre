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
            'has_insurance' => true,
            'policy_num' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'user_id' => User::factory(),
            'med_insurance_id' => 1
        ];
    }
}
