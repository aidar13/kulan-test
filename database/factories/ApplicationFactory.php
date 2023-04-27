<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'          => User::factory()->create(),
            'status_id'        => rand(1, 5),
            'take_date'        => $this->faker->date,
            'from_city_id'     => City::factory()->create(),
            'to_city_id'       => City::factory()->create(),
            'sender_address'   => $this->faker->address,
            'receiver_address' => $this->faker->address,
        ];
    }
}
