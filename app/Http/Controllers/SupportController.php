<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Http\Resources\SupportResource;
use App\Models\Support;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $supports = $this->repository->getSupports($request->all());

        return SupportResource::collection($supports);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSupportRequest $request
     * @return SupportResource
     */
    public function store(StoreSupportRequest $request)
    {
        $support = $this->repository
            ->createNewSupport($request->validated());

        return new SupportResource($support);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function mySupports(Request $request)
    {
        $supports = $this->repository->getMySupports($request->all());

        return SupportResource::collection($supports);
    }
}
