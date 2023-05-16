<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use UtilsTrait;

    public function test__get_modules_unauthenticated()
    {
        $response = $this->getJson('/api/courses/fake_id/modules');

        $response->assertStatus(401);
    }

    public function test__get_all_modules()
    {
        $response = $this->getJson('/api/courses/fake_id/modules', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test__get_all_modules_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/api/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test__get_all_modules_course_total()
    {
        $course = Course::factory()->create();
        $modules = Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/api/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test__get_by_id_modules_course()
    {
        $course = Course::factory()->create();
        $modules = Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/api/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
}
