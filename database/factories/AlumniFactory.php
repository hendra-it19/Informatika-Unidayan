<?php

namespace Database\Factories;

use App\Models\Alumni\Alumni;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumni\Alumni>
 */
class AlumniFactory extends Factory
{
    protected $model = Alumni::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
}
