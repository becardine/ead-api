<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use JsonSerializable;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status] ?? 'Not Found Status',
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'lesson' => new LessonResource($this->whenLoaded('lesson')),
            'replies' => LessonResource::collection($this->whenLoaded('replies')),
            'updated_at' => Carbon::make($this->updated_at)->format('Y-m-d H:i:s')
        ];
    }
}
