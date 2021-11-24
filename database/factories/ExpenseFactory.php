<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'expense_date' => $this->faker->dateTimeBetween('-30 days')->format('d/m/Y H:i:s'),
            'type' => $this->faker->numberBetween(1, 2),
        ];
    }
}
