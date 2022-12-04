<?php

namespace App\Http\Resources;

use App\Models\PetImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PetImage
 */
class PetImageResource extends JsonResource
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
            'filename' => $this->filename
        ];
    }
}
