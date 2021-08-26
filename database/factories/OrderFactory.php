<?php

namespace Database\Factories;

use App\Entities\Order;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account' => $this->faker->randomNumber(5, false),
            'amount' => $this->faker->randomNumber(5, false),
        ];
    }
}
