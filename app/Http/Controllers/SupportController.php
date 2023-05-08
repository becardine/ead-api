<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupport;
use App\Http\Requests\StoreSupport;
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
    public function index(Request $request): AnonymousResourceCollection
    {
        return SupportResource::collection($this->repository->getAllSupports($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSupport $request
     * @return SupportResource
     */
    public function store(StoreSupport $request)
    {
        $support = $this->repository->createNewSupport($request->validated());

        return new SupportResource($support);
    }

    /**
     * Display the specified resource.
     *
     * @param StoreReplySupport $request
     * @param string $supportId
     * @return ReplySupportResource
     */
    public function createReply(StoreReplySupport $request,string $supportId): ReplySupportResource
    {
        $reply = $this->repository->createReplyToSupportId($supportId, $request->validated());

        return new ReplySupportResource($reply);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Support $support
     * @return Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Support $support
     * @return Response
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Support $support
     * @return Response
     */
    public function update(Request $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Support $support
     * @return Response
     */
    public function destroy(Support $support)
    {
        //
    }
}