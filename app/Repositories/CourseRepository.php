<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
        return $this->entity->with('modules.lessons.views')->get();
    }

    /**
     * @param string $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getCourse(string $id)
    {
        return $this->entity->with('modules.lessons')->findOrFail($id);
    }
}
