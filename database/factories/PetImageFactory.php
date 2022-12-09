<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Services\Unsplash\UnsplashService;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetImage>
 */
class PetImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }

    /**
     * @param string $petType
     * @param bool $isTesting
     * @return PetImageFactory
     * @throws Exception
     */
    public function withFile(string $petType, bool $isTesting = false): PetImageFactory
    {
        $image = app(UnsplashService::class)
            ->searchPhotos($petType, 1, 24)
            ->get()
            ->random();

        $content = Http::get($image->downloadLink())->body();
        $fileName = Str::uuid();

        $disk = $isTesting ?
            Storage::fake('public') :
            Storage::disk('public');

        $disk->put("/pet-images/$fileName", $content);

        return $this->state(fn(array $attributes) => [
            'filename' => $fileName,
        ]);
    }

    /**
     * @param Pet $pet
     * @return PetImageFactory
     */
    public function forPet(Pet $pet): PetImageFactory
    {
        return $this->state(fn(array $attributes) => [
            'pet_id' => $pet->id,
        ]);
    }
}
