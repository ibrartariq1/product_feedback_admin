<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB; 
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
        $randomCategoryId = DB::table('categories')->inRandomOrder()->value('id');
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => rand(1, 100),
            'category_id' => $randomCategoryId,
            'image_url' => '/images/your-image-file.jpg',
        ];
    }
}
