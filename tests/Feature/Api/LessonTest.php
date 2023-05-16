<?php

namespace Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use UtilsTrait;
    public function test__get_lessons_unauthenticated()
    {
        $response = $this->getJson('/api/modules/fake_id/lessons');

        $response->assertStatus(401);
    }

    public function test__get_all_lessons_of_module()
    {
        $response = $this->getJson('/api/modules/fake_id/lessons', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test__get_lessons_module()
    {
        $module = Module::factory()->create();

        $response = $this->getJson("/api/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test__get_all_lessons_of_module_total()
    {
        $module = Module::factory()->create();
        $lessons = Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/api/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_get_by_id_lesson_unauthenticated()
    {
        $response = $this->getJson("/api/lessons/fake_id");

        $response->assertStatus(401);
    }

    public function test_get_by_id_lesson_not_found()
    {
        $response = $this->getJson("/api/lessons/fake_id", $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function test_get_by_id_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/api/lessons/{$lesson->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }
}
