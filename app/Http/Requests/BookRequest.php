<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'title' => [
                            'required', 'string', 'min:2', 'max:100', "unique:books,title"
                        ],
                        'author' => [
                            'required', 'string', 'max:100',
                        ],
                        'publish_date' => [
                            'required', 'date', 'before:today',
                        ],
                        'category_id' => [
                            'required', 'exists:categories,id',
                        ],
                        'description' => [
                            'nullable', 'between:3,500',
                        ],
                    ];
                }
            case 'PUT': {
                $id = $this->route('id');
                    return [
                        'title' => [
                            'required', 'string', 'min:2', 'max:100', "unique:books,title, $id ,id",
                        ],
                        'author' => [
                            'required', 'string', 'max:100',
                        ],
                        'publish_date' => [
                            'required', 'before:today',
                        ],
                        'category_id' => [
                            'required', 'exists:categories,id',
                        ],
                        'description' => [
                            'nullable', 'between:3,500',
                        ],
                    ];
                }
        }
    }
}
