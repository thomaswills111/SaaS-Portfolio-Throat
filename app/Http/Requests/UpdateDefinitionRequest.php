<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDefinitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth('sanctum')->user();

        if ($user) {
            if ($user->hasRole('admin|staff|user') || $user->tokenCan('edit definitions')) {
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'word' => [
                    'required',
                    'min:2',
                    'max:32',
                ],
                'definition' => 'required',
                'word_type' => [
                    'required',
                    'min:2',
                    'max:32',
                ],
            ];
        } else {
            return [
                'word' => [
                    'min:2',
                    'max:32',
                    'sometimes'
                ],
                'definition' => 'sometimes',
                'word_type' => [
                    'sometimes',
                    'min:2',
                    'max:32',
                ],
            ];
        }

    }
}
