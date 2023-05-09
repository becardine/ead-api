<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Models\View;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    /**
     * @param string $moduleId
     * @return mixed
     */
    public function getAllLessonsByModuleId(string $moduleId): mixed
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->with('supports.replies')
            ->get();
    }

    /**
     * @param string $id
     * @return Lesson
     */
    public function getLessonById(string $id): Lesson
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * @param string $id
     * @return Lesson
     */
    public function markLessonViewed(string $lessonId): Lesson
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if ($view) {
            return $view->update([
                'qty' => $view->qty + 1
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }
}
