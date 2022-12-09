<?php

namespace App\Http\Requests;

use App\Services\Dto\UserUpdateData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')
                    ->whereNot('id', Auth::guard('web')->id())
            ],
        ];
    }

    public function toRegisterData(): UserUpdateData
    {
        return new UserUpdateData(
            $this->input('name'),
            $this->input('email'),
        );
    }
}
