<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition(): array
    {
        $categories = Category::get('id');
        return [
            'name' => $this->faker->unique()->name,
            'description' => $this->faker->sentence,
            'category_id' => $categories[array_rand($categories->toArray())]
        ];
    }
}
