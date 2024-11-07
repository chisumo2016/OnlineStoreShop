<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpateRequest extends FormRequest
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
        // Get the ID for uniqueness check, or set it to null if creating a new record.
        $id = $this->route('category') ? $this->route('category')->id : null;

        return [
            'icon' => ['required', 'not_in:empty'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id), // Unique with conditional ignore for updates
            ],
            'status' => 'required|boolean',
        ];
    }
}
