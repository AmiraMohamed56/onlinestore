<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        // $categories = ['Men', 'Women', 'Unisex'];

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(12),
            'price' => $this->faker->randomFloat(2, 10, 999.99),
            // 'category' => $this->faker->randomElement($categories),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'image' => $this->faker->randomElement([
                'perfume1.png',
                'perfume2.png',
                'perfume3.png',
                'perfume4.png',
                'perfume5.png',
                'perfume6.png',
                'perfume7.png',
                'perfume.png'
            ]),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean(80), // 80% chance of true
        ];

    }    
}
