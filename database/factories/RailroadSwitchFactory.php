<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RailroadSwitch>
 */
class RailroadSwitchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Cambio '.$this->faker->unique->city(),
            'type_switch' => $this->faker->randomElement(['Num 8','Num 10'])

        ];
    }
}
