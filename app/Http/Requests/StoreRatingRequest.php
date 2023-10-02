<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // This will need to be changed to only allow logged in "admin" to use the update
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /*
         * id         * name         * stars         * icon
         */
        return [
            'name' => [
                'required',
                Rule::unique('ratings', 'name'),
                'min:2',
                'max:32',
            ],
            'icon' => ['required', 'max:24'],
            'stars' => ['required', 'min:0', 'max:10'],
        ];
    }
}
