<?php

namespace App\Services;

use App\Models\Pet;
use App\Models\PetImage;
use App\Services\Dto\PetData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getLatestPets(int $perPage = 10): LengthAwarePaginator
    {
        return Pet::with('images')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * @param PetData $petData
     * @return Pet
     */
    public function save(PetData $petData): Pet
    {
        $isNew = $this->pet == null;

        if ($isNew) {
            $this->setPet(new Pet());
        }

        $this->pet->fill(array_merge([
            'user_id' => Auth::guard('web')->id()
        ], $petData->toArray()))->save();

        if ($isNew) {
            $image = new PetImage();
            $image->pet_id = $this->pet->id;
            $image->filename = basename($petData->getImage()?->store('pet-images', 'public'));
            $image->save();
        }

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
