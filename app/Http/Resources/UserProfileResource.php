<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserProfileResource extends JsonResource
{
    private bool $withPets;

    public function __construct($resource, bool $withPets = true)
    {
        $this->withPets = $withPets;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = [
            'username' => $this->username,
        ];

        if ($this->withPets) {
            $data['pets'] = PetResource::collection($this->pets);
        }

        return $data;
    }
}
