<?php

namespace App\Repositories;

use App\Models\Module;
use App\Models\Support;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    /**
     * @return mixed
     */
    public function getAllModulesByCourseId(string $courseId)
    {
        return $this->entity->where('course_id', $courseId)->get();
    }

    /**
     * @return Module
     */
    public function getModuleByCourseId(string $id, string $courseId): Module
    {
        return $this->entity->where('course_id', $courseId)->findOrFail($id);
    }
}
