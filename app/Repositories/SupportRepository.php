<?php

namespace App\Repositories;

use App\Http\Resources\SupportResource;
use App\Models\ReplySupport;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class SupportRepository
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
     * @param array $data
     * @return Model
     */
    public function createReplyToSupportId(string $supportId, array $data) : Model
    {
        $user = $this->getUserAuth();
        return $this->getSupport($supportId)->replies()->create([
            'description' => $data['description'],
            'user_id' => $user->id,
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

    /**
     * @return User
     */
    private function getUserAuth():User
    {
        // return auth()->user();
        return User::first();
    }

}
