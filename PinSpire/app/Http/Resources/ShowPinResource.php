<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'image'         => $this->image,
            'title'         => $this->title,
            'description'   => $this->description,
            'writer'        => $this->writer['username'],
            'likes'         => $this->likes->count(),
            'comments'      => [
                'total' => $this->comments->count(),
                'Comments' => commentsResource::collection($this->comments),
            ],
            'created_at'    => date_format($this->created_at, "Y/m/d H:i")
        ];
    }
}
