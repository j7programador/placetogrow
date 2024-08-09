<?php

namespace Database\Factories;

use App\Constants\DocumentTypeEnum;
use App\Constants\TypeMicrositeEnum;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->text(20),
            'name' => fake()->company(),
            'document_type' => fake()->randomElement(array_column(DocumentTypeEnum::class::cases(), 'name')),
            'document' => fake()->randomNumber(9),
            'category_id' => fake()->randomElement(Category::all()->pluck('id')->toArray()),
            'type_microsite' => fake()->randomElement(array_column(TypeMicrositeEnum::class::cases(), 'name')),
            'img_url' => url('https://images.unsplash.com/photo-1613243555988-441166d4d6fd?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Site $microsite) {
            $defaultFields = [
                ['label' => 'reference', 'type' => 'string', 'enabled' => true, 'personal_info' => false],
                ['label' => 'description', 'type' => 'string', 'enabled' => true, 'personal_info' => false],
                ['label' => 'currency', 'type' => 'selector', 'enabled' => true, 'personal_info' => false],
                ['label' => 'amount', 'type' => 'integer', 'enabled' => true, 'personal_info' => false],
                ['label' => 'email', 'type' => 'string', 'enabled' => true],
                ['label' => 'document_number', 'type' => 'numeric', 'enabled' => true],
                ['label' => 'document_type', 'type' => 'selector', 'enabled' => true],
                ['label' => 'name', 'type' => 'string', 'enabled' => true],
                ['label' => 'last_name', 'type' => 'string', 'enabled' => true],
                ['label' => 'gateway', 'type' => 'selector', 'enabled' => true, 'personal_info' => false],
            ];

            foreach ($defaultFields as $field) {
                $microsite->fields()->create($field);
            }
        });
    }
}
