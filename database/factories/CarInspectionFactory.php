<?php

namespace Database\Factories;

use App\Models\CarInspection;
use App\Models\CarType;
use App\Models\Initial;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarInspection>
 */
class CarInspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'serie' => $this->faker->unique->numerify('###'),
            'shiftwork' => CarInspection::MATUTINO,
            'le' => $this->faker->randomElement([CarInspection::EMPTY,CarInspection::LOADED]),
            'status' => $this->faker->randomElement([CarInspection::BO,CarInspection::OK]),
            'comment' => $this->faker->text(200),
            'user_id'=>User::all()->random()->id,
            'initial_id'=>Initial::all()->random()->id,
            'car_type_id'=>CarType::all()->random()->id,
            'track_id'=>Track::all()->random()->id,

        ];
    }
}
