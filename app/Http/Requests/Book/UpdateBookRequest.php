<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // we remove the validation rules from controller and put it here
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'author' => ['sometimes', 'string'],
            'description' => ['nullable', 'string'],
            'pages' => ['sometimes', 'integer'],
            'published_at' => ['nullable', 'date'],
        ];

    }
}
