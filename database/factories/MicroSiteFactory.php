<?php

namespace Database\Factories;

use App\Constants\DocumentTypeEnum;
use App\Constants\TypeMicrositeEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MicroSite>
 */
class MicroSiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->text(20),
            'name' => fake()->company(),
            'document_type' => fake()->randomElement(array_column(DocumentTypeEnum::class::cases(), 'name')),
            'document' => fake()->randomNumber(9),
            'category_id' => Category::factory(),
            'type_microsite' => fake()->randomElement(array_column(TypeMicrositeEnum::class::cases(), 'name')),
            'img_url' => url('https://images.unsplash.com/photo-1613243555988-441166d4d6fd?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
        ];
    }
}
