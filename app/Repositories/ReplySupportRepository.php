<?php

namespace App\Repositories;

use App\Http\Resources\SupportResource;
use App\Models\Support;
use App\Models\User;

/**
 *
 */
class ReplySupportRepository
{
    /**
     * @var Support
     */
    protected $entity;

    /**
     * @param Support $model
     */
    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    /**
     * @return mixed
     */
    public function getAllSupports(array $filters = []): mixed
    {
        return $this->getUserAuth()
                    ->supports()
                    ->where(function ($query) use ($filters) {
                        if (isset($filters['lesson'])){
                            $query->where('lesson_id', $filters['lesson']);
                        }
                        if (isset($filters['status'])){
                            $query->where('status', $filters['status']);
                        }
                        if (isset($filters['filter'])){
                            $filter = $filters['filter'];
                            $query->where('description', 'LIKE', "%{$filter}%" );
                        }
                    })
                    ->get();
    }

    /**
     * @return User
     */
    private function getUserAuth():User
    {
        // return auth()->user();
        return User::first();
    }

    /**
     * @param array $data
     * @return Support
     */
    public function createNewSupport(array $data) : Support
    {
        $support = $this->getUserAuth()->supports()->create([
            'lesson_id' => $data['lesson'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);

        return $support;

    }

}
