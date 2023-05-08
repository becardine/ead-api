<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    /**
     * @return mixed
     */
    public function getAllLessonsByModuleId(string $moduleId)
    {
        return $this->entity->where('module_id', $moduleId)->get();
    }

    /**
     * @return Lesson
     */
    public function getLessonByCourseId(string $id, string $moduleId): Lesson
    {
        return $this->entity->where('module_id', $moduleId)->findOrFail($id);
    }
}
