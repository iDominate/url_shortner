<?php

namespace Database\Factories;

use App\Models\UrlEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UrlEntry>
 */
class UrlEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            UrlEntry::ORIGINAL_URL => fake()->url,
            UrlEntry::SHORTEND_URL => fake()->url
        ];
    }
}