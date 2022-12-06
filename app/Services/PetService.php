<?php

namespace App\Services;

use App\Models\Pet;
use App\Services\Dto\PetData;
use App\Services\Dto\PetSearchData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PetService
{
    private ?Pet $pet = null;

    /**
     * @param Pet $pet
     * @return PetService
     */
    public function setPet(Pet $pet): PetService
    {
        $this->pet = $pet;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getAuthUsersPets(): Collection
    {
        return Pet::with('images')
            ->where('user_id', Auth::guard('web')->id())
            ->latest()
            ->get();
    }

    /**
     * @param int $limit
     * @return Collection
     */
    public function getLatestPets(int $limit = 10): Collection
    {
        return Pet::with('images')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * @param PetSearchData $petSearchData
     * @return Collection
     */
    public function search(PetSearchData $petSearchData): Collection
    {
        $res = Pet::query()
            ->where(function (Builder $builder) use ($petSearchData) {
                $search = "%{$petSearchData->getQuery()}%";
                $builder->where('name', 'like', $search)
                    ->orWhere('type', 'like', $search);
            });

        if ($type = $petSearchData->getType()) {
            $res = $res->where('type', $type);
        }

        return $res->get();
    }

    /**
     * @param PetData $petData
     * @return Pet
     */
    public function save(PetData $petData): Pet
    {
        if (!$this->pet) {
            $this->setPet(new Pet());
        }

        $this->pet->fill(array_merge([
            'user_id' => Auth::guard('web')->id()
        ], $petData->toArray()))->save();

        return $this->pet;
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->pet->delete();
    }
}
