<?php

namespace App\Http\Requests;

use App\Enums\PetType;
use App\Services\Dto\PetData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetStoreRequest extends FormRequest
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
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg,gif'],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255', Rule::in(PetType::all())],
            'colors' => ['required', 'array'],
            'colors.*' => ['required', 'string'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
        ];
    }

    public function toPetData(): PetData
    {
        return new PetData(
            $this->input('name'),
            $this->input('type'),
            $this->input('colors'),
            $this->date('date_of_birth'),
            $this->file('image'),
        );
    }
}
