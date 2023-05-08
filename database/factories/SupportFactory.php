<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Module;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Lesson>
 */
class SupportFactory extends Factory
{
    protected $model = Support::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        return [
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'status' => 'P',
            'description' => $this->faker->sentence(20),
        ];
    }
}
