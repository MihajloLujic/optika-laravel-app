<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'   => User::factory(),
            'full_name' => $this->faker->name,
            'address'   => $this->faker->address,
            'phone'     => $this->faker->phoneNumber,
            'total'     => $this->faker->randomFloat(2, 1000, 50000),
            'status'    => $this->faker->randomElement(['pending', 'paid', 'cancelled']),
        ];
    }
}
