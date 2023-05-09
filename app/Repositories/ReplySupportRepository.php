<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Models\Support;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Model;

class ReplySupportRepository
{
    use RepositoryTrait;

    /**
     * @var Support
     */
    protected $entity;

    /**
     * @param ReplySupport $model
     */
    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function createReplyToSupport(array $data) : Model
    {
        $user = $this->getUserAuth();

        return $this->entity->create([
            'support_id' => $data['support'],
            'description' => $data['description'],
            'user_id' => $user->id,
        ]);

    }

}
