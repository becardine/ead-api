<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Model;


class SupportRepository
{
    use RepositoryTrait;

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
                    ->orderBy('updated_at', 'DESC')
                    ->get();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function createNewSupport(array $data) : Model
    {
        return $this->getUserAuth()->supports()->create([
            'lesson_id' => $data['lesson'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);

    }

    /**
     * @param string $supportId
     * @return Support
     */
    private function getSupport(string $supportId):Support
    {
        return $this->entity->findOrFail($supportId);
    }

}
