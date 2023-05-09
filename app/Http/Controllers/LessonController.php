<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViewRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(string $moduleId)
    {
        return LessonResource::collection($this->repository->getAllLessonsByModuleId($moduleId));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return LessonResource
     */
    public function show(Lesson $id)
    {
        return new LessonResource($this->repository->getLessonById($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return JsonResponse
     */
    public function viewed(StoreViewRequest $request): JsonResponse
    {
        $this->repository->markLessonViewed($request->lesson);
        return response()->json(['success' => true]);
    }
}
