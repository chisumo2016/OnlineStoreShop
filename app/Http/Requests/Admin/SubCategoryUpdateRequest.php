<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryUpdateRequest extends FormRequest
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
        // Retrieve the sub_category ID from the route
        $subCategoryId = $this->route('sub_category') ? $this->route('sub_category')->id : null;

        return [
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories', 'name')->ignore($subCategoryId),
            ],
            'status' => 'required|boolean',
        ];
    }
}
