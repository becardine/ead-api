<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $model)
    {
        $this->entity = $model;
    }

    /**
     * @return mixed
     */
    public function getAllCourses()
    {
        return $this->entity->get();
    }

    /**
     * @return Course
     */
    public function getCourse(string $id): Course
    {
        return $this->entity->findOrFail($id);
    }
}
