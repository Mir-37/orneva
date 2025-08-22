<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'brand_id' => Brand::inRandomOrder()->first()->id ?? Brand::factory(),
            'name' => $name,
            'sku' => strtoupper(Str::random(8)),
            'slug' => Str::slug($name) . '-' . rand(1000, 9999),
            'description' => $this->faker->sentence(10),
            'stock' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'flag' => $this->faker->randomElement([null, 'new', 'featured', 'sale']),
            'rating' => $this->faker->optional()->numberBetween(1, 5),
            'rated_by' => null, // skip linking to users for now
            'extras' => null,
        ];
    }
}
