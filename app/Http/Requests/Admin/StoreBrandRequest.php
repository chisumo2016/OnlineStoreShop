<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
        return [
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:1000', // Logo validation
            'name' => 'required|string|max:255|unique:brands,name',
            'is_featured' => 'required|boolean',
            'status' => 'required|boolean',
        ];
    }
}
