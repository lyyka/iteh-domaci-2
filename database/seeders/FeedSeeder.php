<?php

namespace Database\Seeders;

use Database\Factories\PetFactory;
use Database\Factories\PetImageFactory;
use Database\Factories\UserFactory;
use Exception;
use Illuminate\Database\Seeder;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $users = UserFactory::new()->count(10)->create();

        foreach ($users as $user) {
            $pets = PetFactory::new()
                ->forUser($user)
                ->count(3)->create();

            foreach ($pets as $pet) {
                PetImageFactory::new()
                    ->forPet($pet)
                    ->withFile($pet->type)
                    ->create();
            }
        }
    }
}
