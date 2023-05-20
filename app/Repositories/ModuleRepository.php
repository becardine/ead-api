<?php

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $model)
    {
        $this->entity = $model;
    }

    /**
     * @return mixed
     */
    public function getAllModulesByCourseId(string $courseId)
    {
        return $this->entity->with('lessons.views')->where('course_id', $courseId)->get();
    }

    /**
     * @param string $id
     * @param string $courseId
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getModuleByCourseId(string $id, string $courseId)
    {
        return $this->entity->with('lessons.views')->where('course_id', $courseId)->findOrFail($id);
    }
}
