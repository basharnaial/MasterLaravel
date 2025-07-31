<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // by default its false which means we can't add anything
        // we need to change it to true
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
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'pages' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
