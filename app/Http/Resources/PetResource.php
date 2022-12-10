<?php

namespace App\Http\Resources;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Pet
 */
class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'colors' => $this->colors,
            'images' => PetImageResource::collection($this->images),
            'user' => new UserProfileResource($this->user, false),
            'date_of_birth' => $this->date_of_birth,
        ];
    }
}
