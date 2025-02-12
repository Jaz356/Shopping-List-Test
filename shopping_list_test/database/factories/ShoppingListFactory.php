<?php

namespace Database\Factories;

use App\Models\ShoppingList;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoppingListFactory extends Factory
{
    protected $model = ShoppingList::class;

    public function definition()
    {
        return [
            'item' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}