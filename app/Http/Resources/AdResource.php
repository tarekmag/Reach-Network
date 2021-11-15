<?php

namespace App\Http\Resources;

use App\Enums\Define;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'start_date' => $this->start_date->format(Define::DATE_FORMAT_12),
            'category' => $this->category,
            'tags' => TagResource::collection($this->tags),
        ];
    }
}
