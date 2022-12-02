<?php

namespace App\Http\Requests;

use App\Enums\PetType;
use App\Services\Dto\PetSearchData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetSearchRequest extends FormRequest
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
            'q' => ['required', 'string', 'min:2', 'max:255'],
            'type' => ['nullable', 'string', Rule::in(PetType::all())],
        ];
    }

    public function toSearchData() : PetSearchData
    {
        return new PetSearchData(
            $this->input('q'),
            $this->input('type'),
        );
    }
}
