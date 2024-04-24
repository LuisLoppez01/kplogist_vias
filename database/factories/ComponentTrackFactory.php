<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComponentTrack>
 */
class ComponentTrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type_track' => $this->faker->randomElement(['Clasica','Elastica','Clasica/Elastica']),
            'type_tracksleeper_one' => $this->faker->randomElement(['Madera','Concreto']),
            'lenght_tracksleeper_one' => '150',
            'weight_rails_one' => $this->faker->randomElement(['110','115']),
            'lenght_rails_one' => '150',
            'weight_rails_two' => $this->faker->randomElement(['110','115']),
            'lenght_rails_two' => '150',
            'railroadswitch_interior' => $this->faker->randomElement(['8','10']),
            'railroadswitch_exterior' => $this->faker->randomElement(['8','10']),
        ];
    }
}
