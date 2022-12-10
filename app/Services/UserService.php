<?php

namespace App\Services;

use App\Models\User;
use App\Services\Dto\UserRegisterData;
use App\Services\Dto\UserUpdateData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;

class UserService
{
    private ?User $user = null;

    public function __construct(
        private PetService $petService,
    )
    {
    }

    /**
     * @param User|null $user
     * @return UserService
     */
    public function setUser(?User $user): UserService
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function getByUsername(string $username): ?User
    {
        return User::whereUsername($username)->first();
    }

    /**
     * @return NewAccessToken
     */
    public function issueToken(): NewAccessToken
    {
        return $this->user->createToken('auth');
    }

    /**
     * @param UserRegisterData $registerData
     * @return User
     */
    public function register(UserRegisterData $registerData): User
    {
        $user = new User();
        $user->fill($registerData->toArray());
        $user->password = $registerData->getHashedPassword();
        $user->save();

        $this->setUser($user);

        return $user;
    }

    /**
     * @param UserUpdateData $updateData
     * @return User
     */
    public function update(UserUpdateData $updateData): User
    {
        $this->user->fill($updateData->toArray());
        $this->user->save();

        return $this->user;
    }

    /**
     * @param User|array $credentials
     * @return bool
     */
    public function login(User|array $credentials): bool
    {
        if (is_array($credentials)) {
            return Auth::attempt($credentials);
        }

        Auth::login($credentials);
        return Auth::check();
    }

    public function logout(Request $request): void
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    public function delete(): void
    {
        foreach ($this->user->pets as $pet) {
            $this->petService->setPet($pet)->delete();
        }

        $this->user->delete();
    }
}
