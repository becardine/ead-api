<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplySupportRepository;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    protected $repository;

    public function __construct(ReplySupportRepository $replySupportRepository)
    {
        $this->repository = $replySupportRepository;
    }
    public function createReply(StoreReplySupportRequest $request)
    {
        $reply = $this->repository->createReplyToSupport($request->validated());

        return new ReplySupportResource($reply);
    }
}
