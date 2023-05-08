<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    protected $model = Lesson::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        return [
            'name' => $name,
            'url' => Str::slug($name),
            'video' => Str::random(),
            'description' => $this->faker->sentence(20),
            'module_id' => Module::factory()
        ];
    }
}
