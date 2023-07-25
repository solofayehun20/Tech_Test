<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;
use Faker\Generator as Faker;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        $carMakes = ['Toyota', 'Honda', 'Ford', 'Chevrolet'];
        $carModels = ['Camry', 'Civic', 'Focus', 'Cruze'];

        return [
            'make' => $this->faker->randomElement($carMakes),
            'model' => $this->faker->randomElement($carModels),
            'registration' => $this->faker->unique()->regexify('[A-Z]{2}\d{2}[A-Z]{3}'),
        ];
    }
}
