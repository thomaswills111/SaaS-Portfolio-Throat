<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWordTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        if ($user) {
            if ($user->hasRole('admin') || $user->tokenCan('add words types'))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('ratings', 'name'),
                'min:2',
                'max:32',
            ],
            'code' => ['required', 'max:2'],
        ];
    }
}
